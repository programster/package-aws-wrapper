<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-captions
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class Captions implements \JsonSerializable
{
    private $m_arrayForm;


    private function __construct(
        CaptionMergePolicy $mergePolicy,
        CaptionSourceCollection $sources,
        CaptionFormatCollection $captionFormats
    )
    {
        $this->m_arrayForm = array(
            'MergePolicy' => (string)$mergePolicy,
            'CaptionFormats' => $captionFormats,
            'CaptionSources' => $sources
        );
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
