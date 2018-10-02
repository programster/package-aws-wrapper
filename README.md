AWS Wrapper for PHP
========================

This package aims to wrap around Amazons PHP sdk so that it provides the developer with a more object-orientated interface. Thus the developer will spend less time looking up the parameters they can pass into an array.
This version of the wrapper is based on [version 3 of the SDK](https://docs.aws.amazon.com/aws-sdk-php/v3/api/).

## Installation
```bash
composer require irap/aws-Wrapper
```

## Example Usage

```php
<?php

require_once(__DIR__ . '/vendor/autoload.php');

define('S3_BUCKET', 'my-bucket-name');
define('AWS_KEY', 'someKeyValueHere');
define('AWS_SECRET', 'someAwsSecretHere');

$awsWrapper = new \iRAP\AwsWrapper\AwsWrapper(
    AWS_KEY,
    AWS_SECRET,
    iRAP\AwsWrapper\Enums\AwsRegion::create_EU_W1()
);

# Get the S3 client for interfacing with S3, rather than EC2
$s3Client = $awsWrapper->getS3Client();

# Create a private file in S3 called "test-file.txt" that contains the text
# "hello world" in our bucket.
$response = $s3Client->createFile(
    S3_BUCKET,
    "hello world",
    'test-file.txt',
    iRAP\AwsWrapper\S3\Acl::createAuthenticatedRead(),
    iRAP\AwsWrapper\S3\StorageClass::createStandard()
);

```

## Debugging
I've occasionally had issues with running commands that would just block and never return. The solution for me was to install the php-xml package with

```bash
sudo apt-get install php-xml
```

I will remove this note once I have figured out how to make composer require that for installation.
