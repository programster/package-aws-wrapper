<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class AudioCodec
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    public static function createAac() : AudioCodec { return new AudioCodec("AAC"); }
    public static function createFlac() : AudioCodec { return new AudioCodec("flac"); }
    public static function createMp2() : AudioCodec { return new AudioCodec("mp2"); }
    public static function createMp3() : AudioCodec { return new AudioCodec("mp3"); }
    public static function createPcm() : AudioCodec { return new AudioCodec("pcm"); }
    public static function createVorbis() : AudioCodec { return new AudioCodec("vorbis"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

