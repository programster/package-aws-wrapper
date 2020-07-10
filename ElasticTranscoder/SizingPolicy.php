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
    public static function createFit() : SizingPolicy { return new SizingPolicy("Fit"); }


    /**
     * Elastic Transcoder scales to match the value that you specified in MaxWidth or
     * MaxHeight settings and matches or exceeds the other value. Elastic Transcoder centers the image
     * and then crops in the dimension (if any) that exceeds the maximum value.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createFill() : SizingPolicy { return new SizingPolicy("Fill"); }


    /**
     * Elastic Transcoder stretches the input to match the values that you specified for MaxWidth and
     * MaxHeight settings. If the relative proportions of the input video and thumbnails are different, the thumbnails
     * will be distorted.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createStretch() : SizingPolicy { return new SizingPolicy("Stretch"); }


    /**
     * Elastic Transcoder does not scale the video/thumbnail. If either dimension of the input video exceeds the values
     * that you specified for MaxWidth and MaxHeight settings, Elastic Transcoder crops the source.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createKeep() : SizingPolicy { return new SizingPolicy("Keep"); }


    /**
     * Elastic Transcoder scales the video/thumbnail down so that their dimensions match the values that you specified
     * for at least one of thumbnail MaxWidth and MaxHeight without exceeding either value. If you specify this option,
     * Elastic Transcoder does not scale the thumbnail/video up.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createShrinkToFit() : SizingPolicy { return new SizingPolicy("ShrinkToFit"); }


    /**
     * Elastic Transcoder scales the image down so that their dimensions match the values that you specified for at
     * least one of MaxWidth and MaxHeight without dropping below either value. If you specify this option, Elastic
     * Transcoder does not scale the thumbnail/video up.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createShrinkToFill() : SizingPolicy { return new SizingPolicy("ShrinkToFill"); }



    public function __toString()
    {
        return $this->m_value;
    }
}

