<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class PaddingPolicy
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    /**
     * When you set PaddingPolicy to Pad, Elastic Transcoder may add black bars to the top and bottom and/or left and
     * right sides of thumbnails to make the total size of the thumbnails match the values that you specified for
     * thumbnail MaxWidth and MaxHeight settings.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createPad() : PaddingPolicy { return new PaddingPolicy("Pad"); }
    public static function createUnpadded() : PaddingPolicy { return new PaddingPolicy("NoPad"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

