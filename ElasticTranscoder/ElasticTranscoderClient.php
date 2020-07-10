<?php

/*
 * You may find this useful:
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class ElasticTranscoderClient
{
    private $m_client;


    /*
     * Create the elastic transcoder client
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.ElasticTranscoder.ElasticTranscoderClient.html
     */
    public function __construct($apiKey, $apiSecret, \Programster\AwsWrapper\Enums\AwsRegion $region)
    {
        $credentials = array(
            'key'    => $apiKey,
            'secret' => $apiSecret
        );

        $params = array(
            'credentials' => $credentials,
            'version'     => '2012-09-25',
            'region'      => (string) $region,
        );

        $this->m_client = new \Aws\ElasticTranscoder\ElasticTranscoderClient($params);
    }


    /**
     * Creates a transcoding preset with the settings provided.
     * @param string $name
     * @param string $description
     * @param \Programster\AwsWrapper\ElasticTranscoder\VideoContainer $container
     * @param \Programster\AwsWrapper\ElasticTranscoder\PresetAudioConfig $audioConfig
     * @param \Programster\AwsWrapper\ElasticTranscoder\PresetVideoConfig $videoConfig
     * @param \Programster\AwsWrapper\ElasticTranscoder\PresetThumbnailConfig $thumbnailConfig
     * @return type
     */
    public function createPreset(
        string $name,
        string $description,
        VideoContainer $container,
        PresetAudioConfig $audioConfig,
        PresetVideoConfig $videoConfig,
        PresetThumbnailConfig $thumbnailConfig
    )
    {
        $params = array(
            'Name' => $name,
            'Description' => $description,
            'Audio' => $audioConfig->toArray(),
            'Container' => (string)$container,
            'Video' => $videoConfig->toArray(),
            'Thumbnails'  => $thumbnailConfig->toArray(),
        );

        $params = \Safe\json_decode(\Safe\json_encode($params), true);

        #print \Programster\CoreLibs\Core::var_dump($params);
        #die();

        $result = $this->m_client->createPreset($params);
        return $result;
    }


    /**
     * Delete a preset by ID. You can't delete the default presets that are included with Elastic Transcoder.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#deletepreset
     * @param string $id - the ID of the preset to delete.
     * @return type
     */
    public function deletePreset(string $id)
    {
        $params = array('Id' => $id);
        $result = $this->m_client->deletePreset($params);
        return $result;
    }


    /**
     * Create a transcoding job (transcode something).
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#createjob
     */
    public function createJob(TranscodeJob $job)
    {
        $params = json_decode(json_encode($job), true); // convert to one massive assoc array
        return $this->m_client->createJob($params);
    }


    /**
     * Cancel a transcoding job.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#canceljob
     */
    public function cancelJob(string $id)
    {
        $params = array('Id' => $id);
        $result = $this->m_client->cancelJob($params);
        return $result;
    }


    /**
     * Returns detailed information about a job.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#readjob
     */
    public function readJob(string $id)
    {
        $params = array('Id' => $id);
        $result = $this->m_client->readJob($params);
        return $result;
    }


    /**
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#createpipeline
     */
    public function createPipeline()
    {
        throw new \Exception("@TODO");
    }


    /**
     * Get detailed information about a pipeline.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#readpipeline
     * @param string $id - the ID of the pipeline to get info about.
     * @return type
     *
     */
    public function readPipeline(string $id)
    {
        $params = array('Id' => $id);
        $result = $this->m_client->readPipeline($params);
        return $result;
    }


    /**
     * Delete a pipeline by ID
     * You can only delete a pipeline that has never been used or that is not currently in use (doesn't contain any
     * active jobs). If the pipeline is currently in use, DeletePipeline returns an error.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#deletepipeline
     * @param string $id - the ID of the pipeline to delete.
     * @return type
     */
    public function deletePipeline(string $id)
    {
        $params = array('Id' => $id);
        $result = $this->m_client->deletePipeline($params);
        return $result;
    }


    /**
     * Gets a list of the default presets included with Elastic Transcoder and the presets that you've added in an
     * AWS region.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#listpresets
     * @param bool $ascending = To list presets in chronological order by the date and time that they were created,
     *                          enter true. To list presets in reverse chronological order, enter false.
     * @param int|null $pageToken - When Elastic Transcoder returns more than one page of results, use pageToken in
     *                              subsequent GET requests to get each successive page of results.
     * @return type
     */
    public function listPresets(bool $ascending=true, ?int $pageToken = null)
    {
        $params = array(
            'Ascending' => ($ascending) ? "true" : "false"
        );

        if ($pageToken !== null)
        {
            $params['PageToken'] = $pageToken;
        }

        $result = $this->m_client->listPresets($params);
        return $result;
    }


    /**
     * Gets a list of the pipelines associated with the current AWS account.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#listpipelines
     * @param bool $ascending - To list pipelines in chronological order by the date and time that they were created,
     *                          enter true. To list pipelines in reverse chronological order, enter false.
     *
     * @param int|null $pageToken - When Elastic Transcoder returns more than one page of results, use pageToken in
     *                              subsequent GET requests to get each successive page of results.
     * @return type
     */
    public function listPipelines(bool $ascending=true, ?int $pageToken = null)
    {
        $params = array(
            'Ascending' => $id
        );

        if ($pageToken !== null)
        {
            $params['PageToken'] = $pageToken;
        }

        $result = $this->m_client->listPipelines($params);
        return $result;
    }
}
