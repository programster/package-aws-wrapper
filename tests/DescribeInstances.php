<?php

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/Settings.php');

function main()
{
    $apiKey = API_KEY;
    $secret = API_SECRET;
    $region = \Programster\AwsWrapper\Enums\AwsRegion::create_EU_W1();
        
    $awsWrapper = new Programster\AwsWrapper\AwsWrapper($apiKey, $secret, $region);
    
    $request = new Programster\AwsWrapper\Requests\RequestDescribeInstances(Programster\AwsWrapper\Enums\AwsRegion::create_EU_W1());
    $response = $awsWrapper->getEc2Client()->describeInstances($request);
    
    var_dump($response);
}

main();