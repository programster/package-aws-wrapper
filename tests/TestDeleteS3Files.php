<?php

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/Settings.php');

function main()
{
    $region = \Programster\AwsWrapper\Enums\AwsRegion::create_EU_W1();
    $s3client = new \Programster\AwsWrapper\S3\S3Client(API_KEY, API_SECRET, $region);
    
    // create some objects to delete
    $s3client->createFile(
        TEST_BUCKET,
        "hello world",
        "folder1/hello-world2.txt",
        Programster\AwsWrapper\S3\Acl::createPrivate(),
        Programster\AwsWrapper\S3\StorageClass::createStandard()
    );
    
    $response = $s3client->listObjects(TEST_BUCKET, "/folder1");
    $objects = $response->getObjects();
    
    $collection = [];
    
    foreach ($objects as $object) {
        /* @var $object \Programster\AwsWrapper\Objects\S3Object */
        $collection[] = $object->getKey();
    }
    
    $s3client->deleteObjects(TEST_BUCKET, $collection);
}

main();