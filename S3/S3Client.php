<?php

/*
 * You may find this useful:
 * https://docs.aws.amazon.com/aws-sdk-php/v3/guide/service/s3-transfer.html?highlight=upload
 */

namespace Programster\AwsWrapper\S3;

class S3Client
{
    private $m_client;
    
    public function __construct($apiKey, $apiSecret, \Programster\AwsWrapper\Enums\AwsRegion $region)
    {
        $credentials = array(
            'key'    => $apiKey,
            'secret' => $apiSecret
        );
        
        $params = array(
            'credentials' => $credentials,
            'version'     => '2006-03-01',
            'region'      => (string) $region,
        );
        
        $this->m_client = new \Aws\S3\S3Client($params);
    }
    
    
    /**
     * Upload a file to s3
     * https://docs.aws.amazon.com/AmazonS3/latest/dev/UploadObjSingleOpPHP.html
     *
     * @param string $bucket - the bucket that we want to store our file in.
     * @param string $localFilepath - the absolutepath to where the file we want to upload currently is
     * @param string $remoteFilepath - the path you want the file to have inside the bucket, e.g.
     *                                data/data1.csv where "data" is NOT the name of the bucket.
     * @param Acl $acl - the ACL to store the file with. Refer to the Acl Object.
     * @param StorageClass $storageClass - an instance of the StorageClass.
     * @param string $mimeType - the mime type of the file. E.g. text/csv or text/plain
     * @param array $metadata - any name/value pairs you want assosciated with the file.
     * @WARNING - this will overwrite the file if it already exists!
     */
    public function uploadFile(
        $bucket,
        $localFilepath,
        $remoteFilepath,
        Acl $acl,
        StorageClass $storageClass,
        $mimeType,
        $metadata = array()
    ) {
        # Strip off the beginning / if they have provided one. Otherwise you end up with a folder
        # with no name at the top of your bucket.
        if (\iRAP\CoreLibs\StringLib::startsWith($remoteFilepath, '/')) {
            $remoteFilepath = substr($remoteFilepath, 1);
        }
        
        $params = array(
            'Bucket'       => $bucket,
            'Key'          => $remoteFilepath,
            'SourceFile'   => $localFilepath,
            'ContentType'  => $mimeType,
            'ACL'          => (string) $acl,
            'StorageClass' => (string) $storageClass,
            'Metadata'     => $metadata
        );
        
        $result = $this->m_client->putObject($params);
        
        return $result;
    }
    
    
    /**
     * Upload a file to s3
     * Create a file in s3 with the provided string body.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.S3.S3Client.html#_upload
     *
     * @param string $bucket - the bucket that we want to store our file in.
     * @param string $body - the string content or stream of something  to create file from
     * @param string $remoteFilepath - the path you want the file to have inside the bucket, e.g.
     *                                data/data1.csv where "data" is NOT the name of the bucket.
     * @param Acl $acl - the ACL to store the file with. Refer to the Acl Object.
     * @param StorageClass $storageClass - an instance of the StorageClass.
     * @param string $mimeType - the mime type of the file. E.g. text/csv or text/plain. Without
     *                            this, it will default to octet/stream which may or may not matter
     * @param array $metadata - optional name/value pairs you want assosciated with the file.
     * @WARNING - this will overwrite the file if it already exists!
     */
    public function createFile(
        $bucket,
        $body,
        $remoteFilepath,
        Acl $acl,
        StorageClass $storageClass,
        $mimeType = '',
        $metadata = array()
    ) {
        # Strip off the beginning / if they have provided one. Otherwise you end up with a folder
        # with no name at the top of your bucket.
        if (\iRAP\CoreLibs\StringLib::startsWith($remoteFilepath, '/')) {
            $remoteFilepath = substr($remoteFilepath, 1);
        }
        
        $params = array(
            'StorageClass' => (string) $storageClass,
            'Metadata'     => $metadata,
        );
        
        if ($mimeType !== '') {
            $params['ContentType'] = $mimeType;
        }
        
        $options = array('params' => $params);
        
        $result = $this->m_client->upload(
            $bucket,
            $remoteFilepath,
            $body,
            (string) $acl,
            $options
        );
        
        return $result;
    }
    
    
    /**
     * Upload an entire directory to S3
     * @param string $localDirectoryPath - the path to the directory we wish to upload.
     * @param string $bucketName - the name of the bucket to store the files in.
     * @param Acl $acl - the ACL you want for all the files. For example Acl::createPublicRead()
     * @param string $remotePath - a path to stick the files in from inside the bucket. E.g.
     *                             '/subfolder1/subfolder2'. This MUST start with /
     */
    public function uploadDirectory($localDirectoryPath, $bucketName, Acl $acl, $remotePath = '')
    {
        // If the user provided a starting slash, this is a mistake and needs to be stripped.
        // for some reason paths are not like linux absolute paths
        if (\iRAP\CoreLibs\StringLib::startsWith($remotePath, "/")) {
            $remotePath = substr($remotePath, 1);
        }
        
        $dest = 's3://' . $bucketName . "/" . $remotePath;
        $aclString = (string)$acl;
        
        $beforeFunc = function (\Aws\CommandInterface $command) use ($aclString) {
            if (in_array($command->getName(), ['PutObject', 'CreateMultipartUpload'])) {
                $command['ACL'] = $aclString;
            }
        };
        
        $options = array('before' => $beforeFunc);
        $manager = new \Aws\S3\Transfer($this->m_client, $localDirectoryPath, $dest, $options);
        $manager->transfer();
    }
    
    
    /**
     * Download a file from s3. This is only really useful for private files and will generate
     * a pre signed request from the url. If your files are not private, you can just use the
     * ObjectURL property in the returned object when you uploaded the file.
     *
     * Reference:
     * https://docs.aws.amazon.com/aws-sdk-php/v3/guide/service/s3-presigned-url.html
     *
     * @param string $bucket - the bucket that we want to store our file in.
     * @param string $key - the name of the file in the bucket or the path within the bucket.
     * @param string $downloadFilepath - where to stick the downloaded file including the name.
     *
     * @WARNING - this will overwrite the file if it already exists!
     */
    public function downloadFile($bucket, $key, $downloadFilepath)
    {
        $cmd = $this->m_client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key'    => $key
        ]);
        
        $expires = '+1 minutes';
        $request = $this->m_client->createPresignedRequest($cmd, $expires);
        $presignedUrl = (string) $request->getUri();
        $fileHandle = @fopen($presignedUrl, 'r');
        
        if ($fileHandle === false) {
            throw new \Exception("Failed to find/open the S3 file.");
        }
        
        file_put_contents($downloadFilepath, $fileHandle);
    }
    
    
    /**
     * Get a pre-signed download link from s3. This is only really useful for private files and will generate
     * a pre signed request from the url. If your files are not private, you can just use the
     * ObjectURL property in the returned object when you uploaded the file.
     *
     * Reference:
     * https://docs.aws.amazon.com/aws-sdk-php/v3/guide/service/s3-presigned-url.html
     *
     * @param string $bucket - the bucket that we want to store our file in.
     * @param string $key - the name of the file in the bucket or the path within the bucket.
     * @param int $ttl - lifetime of the link in seconds
     *
     */
    public function createPresignedRequest($bucket, $key, $ttl)
    {
        $cmd = $this->m_client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key'    => $key
        ]);
        
        $expires = '+' . $ttl . ' seconds';
        $request = $this->m_client->createPresignedRequest($cmd, $expires);
        $presignedUrl = (string) $request->getUri();
        return $presignedUrl;
    }
    
    
    /**
     * Delete a bucket and all of its contents from S3
     * @param string $bucketName - the name of the bucket you wish to delete.
     * @return type
     */
    public function deleteBucket($bucketName)
    {
        $params = array(
            'Bucket' => $bucketName
        );
        
        $result = $this->m_client->deleteBucket($params);
        
        return $result;
    }
    
    
    /**
     * List all the buckets in your region.
     */
    public function listBuckets()
    {
        $result = $this->m_client->listBuckets(array());
        return $result;
    }
    
    
    /**
     * Returns some or all (up to 1000] of the objects in a bucket. You can use the request
     * parameters as selection criteria to return a subset of the objects in a bucket.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#listobjects
     * @param string $bucket - the name of the bucket to get the objects of.
     * @param string $prefix - Limits the response to keys that begin with the specified prefix.
     * @param int $maxKeys - Sets the maximum number of keys returned in the response.
     *                        The response might contain fewer keys but will never contain more.
     * @param string $delimiter - A delimiter is a character you use to group keys.
     */
    public function listObjects(
        string $bucket,
        string $prefix = "",
        int $maxKeys = 1000,
        string $delimiter = ""
    ) : \Programster\AwsWrapper\Responses\ResponseListObjects 
    {
        // If the user provided a starting slash, this is a mistake and needs to be stripped.
        // for some reason paths are not like linux absolute paths
        if (\iRAP\CoreLibs\StringLib::startsWith($prefix, "/")) {
            $prefix = substr($prefix, 1);
        }
        
        $params = array(
            'Bucket'        => $bucket, // REQUIRED
            'MaxKeys'       => $maxKeys,
        );
        
        if ($prefix !== "") {
            $params['Prefix'] = $prefix;
        }
        
        if ($delimiter !== "") {
            $params['Delimiter'] = $delimiter;
        }
        
        $awsResponse = $this->m_client->listObjects($params);
        return new \Programster\AwsWrapper\Responses\ResponseListObjects($awsResponse);
    }
    
    
    /**
     * Create a bucket
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#createbucket
     * @return \Aws\Result
     */
    public function createBucket($bucketName, \Programster\AwsWrapper\S3\Acl $acl)
    {
        $params = array(
            'ACL'    => (string) $acl,
            'Bucket' => $bucketName
        );
        
        $result = $this->m_client->createBucket($params);
        return $result;
    }
    
    
    /**
     * Download an entire bucket to a local directory.
     * @param string $bucketName - the name of the bucket we are grabbing.
     * @param string $destination - path to a directory where to store the bucket's files
     */
    public function downloadBucket($bucketName, $destination)
    {
        if (!is_dir($destination)) {
            throw new Exception('Destination needs to be a path to a folder,');
        }
        
        // Where the files will be source from
        $source = 's3://' . $bucketName;
        
        $manager = new \Aws\S3\Transfer($this->m_client, $source, $destination);
        $manager->transfer();
    }
    
    
    /**
     * Delete the specified objects/files from the bucket
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#deleteobjects
     * @param string $bucket
     * @param array $names
     */
    public function deleteObjects(string $bucket, array $names)
    {
        $objectsArray = [];
        
        foreach ($names as $name) {
            $objectsArray[] = array('Key' => $name);
        }
        
        $params = array(
            'Bucket' => $bucket,
            'BypassGovernanceRetention' => true,
            'Delete' => [
                'Objects' => $objectsArray,
                'Quiet' => true,
            ]
        );
        
        $response = $this->m_client->deleteObjects($params);
        return $response;
    }
    
    
    /**
     * Delete a "folder" within an S3 bucket. E.g. you want to delete all objects underneath /folder1
     * @param string $bucketName - the name of the bucket to delete from
     * @param string $path - the path to the folder within the bucket that you wish to delete.
     */
    public function deleteFolder(string $bucketName, string $path)
    {
        if (\iRAP\CoreLibs\StringLib::startsWith($path, '/')) {
            $path = substr($path, 1);
        }
        
        $isTruncated = true;
        
        while ($isTruncated) {
            $listObjectsResponse = $this->listObjects($bucketName, $path);
            $isTruncated = $listObjectsResponse->isTruncated();
            $objects = $listObjectsResponse->getObjects();
            $collection = [];
            
            if (count($objects) > 0) {
                foreach ($objects as $object) {
                    /* @var $object \Programster\AwsWrapper\Objects\S3Object */
                    $collection[] = $object->getKey();
                }
                
                $this->deleteObjects($bucketName, $collection);
            }
        }
    }


    /**
     * Loops through the objects in a bucket, executing your callback on each one. 
     * Use this instead of listObjects if you need to not worry about maxKeys being 1000.
     * @param string $bucket - the name of the bucket that contains your objects.
     * @param string $prefix - Limits the response to keys that begin with the specified prefix.
     * @param \Programster\AwsWrapper\S3\S3WalkerInterface $callback - a handler of the objects.
     */
    public function listObjectsWalk(S3WalkerInterface $callback, string $bucket, string $prefix = "") : void
    {
        $iterator = $this->m_client->getIterator('ListObjects', array('Bucket' => $bucket, 'Prefix' => $prefix));

        foreach ($iterator as $object) 
        {
            $callback->handle(new \Programster\AwsWrapper\Objects\S3Object($object));
        }
    }
}
