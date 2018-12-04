<?php

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/Settings.php');

function main()
{
    $apiKey = API_KEY;
    $secret = API_SECRET;
    $region = \Programster\AwsWrapper\Enums\AwsRegion::create_EU_W1();
        
    $awsWrapper = new Programster\AwsWrapper\AwsWrapper($apiKey, $secret, $region);
    $ec2Client = $awsWrapper->getEc2Client();
    
    
    $ubuntuImage = 'ami-47a23a30';
    $launchSpecification = new \Programster\AwsWrapper\Objects\LaunchSpecification(\Programster\AwsWrapper\Enums\Ec2InstanceType::createT2(1), $ubuntuImage);
    $request = new Programster\AwsWrapper\Requests\RequestRunInstances($launchSpecification, 1, 1);
    $ec2Client->runInstances($request);
    
    $instances = $request->getSpawnedInstances();
        
    $terminationRequest = new \Programster\AwsWrapper\Requests\RequestTerminateInstance($instances);
    $response = $awsWrapper->getEc2Client()->terminateInstances($terminationRequest);
    var_dump($response);
}

main();