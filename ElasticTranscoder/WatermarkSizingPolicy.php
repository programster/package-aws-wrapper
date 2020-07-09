<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class WatermarkSizingPolicy
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    /**
     * Elastic Transcoder scales thumbnails so they match the value that you specified
     * in thumbnail MaxWidth or MaxHeight settings without exceeding the other value.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createFit() : VideoContainer { return new VideoContainer("Fit"); }


    /**
     * Elastic Transcoder stretches thumbnails to match the values that you specified for thumbnail MaxWidth and
     * MaxHeight settings. If the relative proportions of the input video and thumbnails are different, the thumbnails
     * will be distorted.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createStretch() : VideoContainer { return new VideoContainer("Stretch"); }


    /**
     * Elastic Transcoder scales thumbnails down so that their dimensions match the values that you specified for at
     * least one of thumbnail MaxWidth and MaxHeight without exceeding either value. If you specify this option,
     * Elastic Transcoder does not scale thumbnails up.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createShrinkToFit() : VideoContainer { return new VideoContainer("ShrinkToFit"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

