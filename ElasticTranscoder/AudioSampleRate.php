<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class AudioSampleRate
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    public static function createAuto() : AudioSampleRate { return new AudioSampleRate("auto"); }
    public static function create22050() : AudioSampleRate { return new AudioSampleRate("22050"); }
    public static function create32000() : AudioSampleRate { return new AudioSampleRate("32000"); }
    public static function create44100() : AudioSampleRate { return new AudioSampleRate("44100"); }
    public static function create48000() : AudioSampleRate { return new AudioSampleRate("48000"); }
    public static function create96000() : AudioSampleRate { return new AudioSampleRate("96000"); }


    public function __toString()
    {
        return $this->m_value;
    }
}
