<?php

/*
 * This test ensures that we can upload a file to S3
 */

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/Settings.php');

function main()
{
    $apiKey = API_KEY;
    $secret = API_SECRET;
    $region = \Programster\AwsWrapper\Enums\AwsRegion::create_from_string(API_REGION);
    
    $bucketName = "awswrapper-testing";
    
    $awsWrapper = new Programster\AwsWrapper\AwsWrapper($apiKey, $secret, $region);
    $s3Client = $awsWrapper->getS3Client();
    
    # Create the bucket
    $acl = \Programster\AwsWrapper\S3\Acl::createPublicRead();
    
    try {
        $response = $s3Client->createBucket($bucketName, $acl);
    } catch (Aws\S3\Exception\S3Exception $e) {
        if ($e->getCode() == "BucketAlreadyOwnedByYou") { # @TODO objectify these codes
            print "You have already created that bucket" . PHP_EOL;
        } else {
            print $e->getMessage();
            die();
        }
    }
   
    # Upload a file to the new bucket
    $uploadResult = $s3Client->uploadFile(
        $bucketName,
        $localFile = __DIR__ . '/upload-test-file.txt',
        $remoteFilepath = '/upload-test-file.txt',
        \Programster\AwsWrapper\S3\Acl::createPublicRead(),
        \Programster\AwsWrapper\S3\StorageClass::createStandard(),
        $mimeType = 'text/plain'
    );
    
    print_r($uploadResult);
    
    $secondUploadResult = $s3Client->createFile(
        $bucketName,
        $content = "created a file from a string rather than a file",
        $remoteFilepath = '/created-file.txt',
        \Programster\AwsWrapper\S3\Acl::createPublicRead(),
        \Programster\AwsWrapper\S3\StorageClass::createStandard(),
        $mimeType = 'text/plain'
    );
    
    print_r($secondUploadResult);
    
    # list files
    $listObjectsResponse = $s3Client->listObjects($bucketName);
    print_r($listObjectsResponse);
    
    # Delete the file.
    
    
    # Delete the bucket (it doesnt have to be empty)
}

main();