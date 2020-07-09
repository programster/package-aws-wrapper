<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class AudioBitDepth
{
    private $m_value;


    private function __construct(int $value)
    {
        $this->m_value = $value;
    }


    public static function create16() : AudioBitDepth { return new AudioBitDepth("16"); }
    public static function create24() : AudioBitDepth { return new AudioBitDepth("24"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

