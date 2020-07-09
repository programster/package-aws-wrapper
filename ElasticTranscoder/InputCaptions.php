<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-inputcaptions
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class InputCaptions implements \JsonSerializable
{
    private $m_arrayForm;


    private function __construct(CaptionMergePolicy $mergePolicy, CaptionSources ...$sources)
    {
        $this->m_arrayForm = array(
            'MergePolicy' => $mergePolicy,
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
