<?php

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/Settings.php');


function main()
{
    $region = \Programster\AwsWrapper\Enums\AwsRegion::create_ireland();

    $transcoderClient = new Programster\AwsWrapper\ElasticTranscoder\ElasticTranscoderClient(
        API_KEY,
        API_SECRET,
        $region
    );

    $response = $transcoderClient->listPresets();
    die(print_r($response,true));
}

main();