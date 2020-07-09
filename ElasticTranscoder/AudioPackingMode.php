<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class AudioPackingMode
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }



    public static function createSingleTrack(int $keyframesMaxDist) : AudioPackingMode { return new VideoContainer("H.264", $keyframesMaxDist); }
    public static function createOneChannelPerTrack(int $keyframesMaxDist) : AudioPackingMode { return new VideoContainer("H.264", $keyframesMaxDist); }
    public static function createOneChannelPerTrackWithMosTo8Tracks(int $keyframesMaxDist) : AudioPackingMode { return new VideoContainer("H.264", $keyframesMaxDist); }



    public function __toString()
    {
        return $this->m_value;
    }
}

