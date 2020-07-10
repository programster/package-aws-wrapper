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
    public static function createAuto() : AudioChannels { return new AudioChannels("auto"); }

    /**
     * Remove audio from the output
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioCodec
     */
    public static function CreateNone() : AudioChannels { return new AudioChannels("0"); }

    /**
     * Create an output with Mono (single) audio.
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioCodec
     */
    public static function createMono() : AudioChannels { return new AudioChannels("1"); }

    /**
     * Create an output with stereo output (2 channels).
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioCodec
     */
    public static function createStereo() : AudioChannels { return new AudioChannels("2"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

