<?php

/*
 * This is exactly the same as the Timespan object, except that we json_encode differently.
 */


namespace Programster\AwsWrapper\ElasticTranscoder;


class Clip extends TimeSpan
{
    public function jsonSerialize()
    {
        return array(
            'TimeSpan' => $this->m_arrayForm
        );
    }
}



