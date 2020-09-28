<?php

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/Settings.php');

function main()
{
    $apiKey = API_KEY;
    $secret = API_SECRET;
    $region = \Programster\AwsWrapper\Enums\AwsRegion::create_london();

    $awsWrapper = new Programster\AwsWrapper\AwsWrapper($apiKey, $secret, $region);
    $ec2Client = $awsWrapper->getEc2Client();

    $ubuntuImage = 'ami-05c424d59413a2876'; // ubuntu 20.04 in eu-west-2
    $launchSpecification = new \Programster\AwsWrapper\Objects\LaunchSpecification(\Programster\AwsWrapper\Enums\Ec2InstanceType::createT2(1), $ubuntuImage);
    $request = new Programster\AwsWrapper\Requests\RequestRunInstances($launchSpecification, 2, 2);
    $response = $ec2Client->runInstances($request);

    print "Waiting for instances to finish spawning..." . PHP_EOL;
    sleep(60);

    $instanceIds = array();

    foreach ($request->getSpawnedInstances() as $instance)
    {
        /* @var $instance \Programster\AwsWrapper\Ec2\Ec2Instance */
        $instanceIds[] = $instance->getInstanceId();
    }

    print "Sending request to stop the instances..." . PHP_EOL;
    $requestStopInstances = new \Programster\AwsWrapper\Requests\RequestStopInstances(...$instanceIds);
    $stopInstancesResponse = $ec2Client->stopInstances($requestStopInstances);

    print "Waiting for instances to finish stopping..." . PHP_EOL;
    sleep(60);

    print "Sending request to start the instances..." . PHP_EOL;
    $startInstancesRequest = new \Programster\AwsWrapper\Requests\RequestStartInstances(...$instanceIds);
    $startInstancesResponse = $ec2Client->startInstances($startInstancesRequest);

    sleep(60);

    print "Sending request to terminate the instances..." . PHP_EOL;
    $startInstancesRequest = new \Programster\AwsWrapper\Requests\RequestTerminateInstance($instanceIds);
    $startInstancesResponse = $ec2Client->terminateInstances($startInstancesRequest);

    print "stop instances response: " . PHP_EOL . print_r($stopInstancesResponse, true) . PHP_EOL;
    print "start instances response: " . PHP_EOL . print_r($startInstancesResponse, true) . PHP_EOL;
}

main();