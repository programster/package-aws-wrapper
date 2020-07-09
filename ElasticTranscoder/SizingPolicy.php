<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class SizingPolicy
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
     * Elastic Transcoder scales thumbnails so they match the value that you specified in thumbnail MaxWidth or
     * MaxHeight settings and matches or exceeds the other value. Elastic Transcoder centers the image in thumbnails
     * and then crops in the dimension (if any) that exceeds the maximum value.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createFill() : VideoContainer { return new VideoContainer("Fill"); }


    /**
     * Elastic Transcoder stretches thumbnails to match the values that you specified for thumbnail MaxWidth and
     * MaxHeight settings. If the relative proportions of the input video and thumbnails are different, the thumbnails
     * will be distorted.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createStretch() : VideoContainer { return new VideoContainer("Stretch"); }


    /**
     * Elastic Transcoder does not scale thumbnails. If either dimension of the input video exceeds the values that
     * you specified for thumbnail MaxWidth and MaxHeight settings, Elastic Transcoder crops the thumbnails.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createKeep() : VideoContainer { return new VideoContainer("Keep"); }


    /**
     * Elastic Transcoder scales thumbnails down so that their dimensions match the values that you specified for at
     * least one of thumbnail MaxWidth and MaxHeight without exceeding either value. If you specify this option,
     * Elastic Transcoder does not scale thumbnails up.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createShrinkToFit() : VideoContainer { return new VideoContainer("ShrinkToFit"); }


    /**
     * Elastic Transcoder scales thumbnails down so that their dimensions match the values that you specified for at
     * least one of MaxWidth and MaxHeight without dropping below either value. If you specify this option, Elastic
     * Transcoder does not scale thumbnails up.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createShrinkToFill() : VideoContainer { return new VideoContainer("ShrinkToFill"); }



    public function __toString()
    {
        return $this->m_value;
    }
}

