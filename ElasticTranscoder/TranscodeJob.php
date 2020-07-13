<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-audioparameters
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class TranscodeJob implements \JsonSerializable
{
    private $m_id;
    private $m_arn;
    private $m_pipelineId;
    private $m_input;
    private $m_inputs;
    private $m_output;
    private $m_outputs;


    private $m_arrayForm;


    /**
     * Private constructor. If you wish to manually create a transcode job, please use the
     * createNew() method.
     */
    private function __construct()
    {

    }


    /**
     * Manually create a new transcode job for sending a request.
     * @param string $pipelineId
     * @param \Programster\AwsWrapper\ElasticTranscoder\CreateJobInput $input
     * @param \Programster\AwsWrapper\ElasticTranscoder\PlaylistCollection|null $playlistCollection
     * @param string|null $outputKeyPrefix
     * @param \Programster\AwsWrapper\ElasticTranscoder\CreateJobOutputCollection $outputs
     * @return \Programster\AwsWrapper\ElasticTranscoder\TranscodeJob
     */
    public static function createNew(
        string $pipelineId,
        CreateJobInput $input,
        ?PlaylistCollection $playlistCollection,
        ?string $outputKeyPrefix,
        CreateJobOutputCollection $outputs
    ) : TranscodeJob
    {
        $job = new TranscodeJob();
        $job->m_pipelineId = $pipelineId;
        $job->m_input = $input;
        $job->m_outputs = $outputs;

        $job->m_arrayForm = array(
            'PipelineId' => $pipelineId,
            'Input' => $input->toArray(),
            'Outputs' => $outputs->getArrayCopy()
        );

        if ($playlistCollection !== null)
        {
            $job->m_arrayForm['Playlists'] = $playlistCollection->getArrayCopy();
        }

        if ($outputKeyPrefix !== null)
        {
            $job->m_arrayForm['OutputKeyPrefix'] = $outputKeyPrefix;
        }

        return $job;
    }


    /**
     * Create this object from an aws createJob response array. Refer to ResponseCreateJob.
     * @param array $responseArray
     */
    public static function createFromArray(array $responseArray) : TranscodeJob
    {
        $job = new TranscodeJob();
        $job->m_arrayForm = $responseArray;
        $job->m_id = $responseArray['Id'];
        $job->m_arn = $responseArray['Arn'];
        $job->m_pipelineId = $responseArray['PipelineId'];
        $job->m_input = $responseArray['Input'];
        $job->m_inputs = $responseArray['Inputs'];
        $job->m_output = $responseArray['Output'];
        $job->m_outputs = $responseArray['Outputs'];
        return $job;
    }


    public function toArray() : array
    {
        return $this->m_arrayForm;
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }


    # Accessors
    /**
     * Get the ID of the job. If this object was created as part of a createJob response, an ID will be set.
     * The ID will be somethinng like "1594629649598-tk34t0"
     * @return string|null
     */
    public function getId() : ?string { return $this->m_id; }


    /**
     * Get the arn of the job. If this object was created as part of a createJob response, an ID will be set.
     * The ID will be somethinng like "arn:aws:elastictranscoder:eu-west-1:912962575262:job/1594629649598-tk34t0"
     * @return string|null
     */
    public function getArn() { return $this->m_arn; }


    public function getPipelineId() : string { return $this->m_pipelineId; }
    public function getInput() { return $this->m_input; }
    public function getInputs() { return $this->m_inputs; }
    public function getOutput() { return $this->m_output; }
    public function getOutputs() { return $this->m_ouptuts; }
}

