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

    // 720p output
    $output1 = new \Programster\AwsWrapper\ElasticTranscoder\CreateJobOutput(
        "hls_1m_", // key
        "1351620000001-200035",
        9 // segment duration
    );

    // higher resolution 1080p output
    $output2 = new \Programster\AwsWrapper\ElasticTranscoder\CreateJobOutput(
        "hls_2m_", // key
        "1351620000001-200015", // preset ID
        9 // segment duration
    );

    $outputs = new \Programster\AwsWrapper\ElasticTranscoder\CreateJobOutputCollection($output1, $output2);

    $playlist = new Programster\AwsWrapper\ElasticTranscoder\CreateJobPlaylist(
        Programster\AwsWrapper\ElasticTranscoder\PlaylistFormat::createHlsV3(),
        "MyPlaylist",
        $outputs
    );

    $playlistCollection = new \Programster\AwsWrapper\ElasticTranscoder\PlaylistCollection($playlist);

    $jobInput = new \Programster\AwsWrapper\ElasticTranscoder\CreateJobInput("MyTestVideo.mp4");

    $transcodeJob = new \Programster\AwsWrapper\ElasticTranscoder\TranscodeJob(
        '1581081524632-3qaw4r', // $pipelineId,
        $jobInput,
        $playlistCollection,
        'testing/', //$outputKeyPrefix,
        $outputs
    );

    $response = $transcoderClient->createJob($transcodeJob);
    die(print_r($response, true));
}

main();