<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class AudioProfile
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    /**
     * Elastic Transcoder selects the profile based on the bit rate selected for the output file.
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioProfile
     */
    public static function createAuto() : AudioProfile { return new AudioProfile("auto"); }


    /**
     * The most common AAC profile. Use for bit rates larger than 64 kbps.
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioProfile
     */
    public static function createAacLc() : AudioProfile { return new AudioProfile("AAC-LC"); }


    /**
     * Not supported on some older players and devices. Use for bit rates between 40 and 80 kbps.
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioProfile
     */
    public static function createHeAac() : AudioProfile { return new AudioProfile("HE-AAC"); }


    /**
     * Not supported on some players and devices. Use for bit rates less than 48 kbps.
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioProfile
     */
    public static function createHeAacV2() : AudioProfile { return new AudioProfile("HE-AACv2"); }



    public function __toString()
    {
        return $this->m_value;
    }
}
