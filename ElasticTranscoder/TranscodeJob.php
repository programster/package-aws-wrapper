<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-audioparameters
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class TranscodeJob implements \JsonSerializable
{
    private $m_arrayForm;


    /**
     *
     */
    public function __construct(
        string $pipelineId,
        JobInput $input,
        ?PlaylistCollection $playlistCollection,
        ?string $outputKeyPrefix,
        JobOutput ...$outputs
    )
    {
        $this->m_arrayForm = array(
            'PipelineId' => $pipelineId,
            'Input' => $input,
            'Outputs' => $outputs
        );

        if ($playlistCollection !== null)
        {
            $this->m_arrayForm['Playlists'] = $playlistCollection;
        }

        if ($outputKeyPrefix !== null)
        {
            $this->m_arrayForm['OutputKeyPrefix'] = $outputKeyPrefix;
        }
    }


    public function toArray() : array
    {
        return $this->m_arrayForm;
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }
}

