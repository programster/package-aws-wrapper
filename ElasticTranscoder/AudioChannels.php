<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class AudioChannels
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    /**
     * Automatically use the same number of channels as the input source.
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioCodec
     */
    public static function createAuto() : AudioCodec { return new AudioCodec("auto"); }

    /**
     * Remove audio from the output
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioCodec
     */
    public static function CreateNone() : AudioCodec { return new AudioCodec("0"); }

    /**
     * Create an output with Mono (single) audio.
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioCodec
     */
    public static function createMono() : AudioCodec { return new AudioCodec("1"); }

    /**
     * Create an output with stereo output (2 channels).
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioCodec
     */
    public static function createStereo() : AudioCodec { return new AudioCodec("2"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

