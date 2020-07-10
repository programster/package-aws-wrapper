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

    $audioConfig = new Programster\AwsWrapper\ElasticTranscoder\PresetAudioConfig(
        \Programster\AwsWrapper\ElasticTranscoder\AudioCodec::createAac(),
        160,
        \Programster\AwsWrapper\ElasticTranscoder\AudioCodecOptions::createForAac(\Programster\AwsWrapper\ElasticTranscoder\AudioProfile::createAacLc())
    );

    $videoCodecOptions = Programster\AwsWrapper\ElasticTranscoder\VideoCodecOptions::createForH264(
        Programster\AwsWrapper\ElasticTranscoder\VideoCodecProfile::createBaseline(),
        Programster\AwsWrapper\ElasticTranscoder\H264Level::create4_1(),
        3,
        null,
        null,
        null,
        null,
        null
    );

    $videoConfig = new Programster\AwsWrapper\ElasticTranscoder\PresetVideoConfig(
        Programster\AwsWrapper\ElasticTranscoder\VideoContainer::createMpegTs(),
        \Programster\AwsWrapper\ElasticTranscoder\VideoCodec::createH264(90, false),
        $videoCodecOptions,
        1080, // max height
        1920, // max width
        5400, // bitrate
        \Programster\AwsWrapper\ElasticTranscoder\PaddingPolicy::createUnpadded(),
        \Programster\AwsWrapper\ElasticTranscoder\SizingPolicy::createShrinkToFit()
    );

    $thumbnailconfig = new \Programster\AwsWrapper\ElasticTranscoder\PresetThumbnailConfig(
        Programster\AwsWrapper\ElasticTranscoder\ImageFormat::createPng(),
        60, // interval
        144, // max height
        192, // max width
        \Programster\AwsWrapper\ElasticTranscoder\PaddingPolicy::createUnpadded(),
        \Programster\AwsWrapper\ElasticTranscoder\SizingPolicy::createShrinkToFit()
    );

    // create some objects to delete
    $response = $transcoderClient->createPreset(
        "MyTestPreset",
        "This is a test preset",
        Programster\AwsWrapper\ElasticTranscoder\VideoContainer::createMpegTs(),
        $audioConfig,
        $videoConfig,
        $thumbnailconfig
    );

    die(print_r($response, true));
}

main();