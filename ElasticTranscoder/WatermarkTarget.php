<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class WatermarkTarget
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    /**
     *  HorizontalOffset and VerticalOffset values are calculated based on the borders of the video excluding black
     * bars added by Elastic Transcoder, if any. In addition, MaxWidth and MaxHeight, if specified as a percentage,
     * are calculated based on the borders of the video excluding black bars added by Elastic Transcoder, if any.
     */
    public static function createContent() : WatermarkTarget { return new WatermarkTarget("Content"); }


    /**
     * HorizontalOffset and VerticalOffset values are calculated based on the borders of the video including black
     * bars added by Elastic Transcoder, if any. In addition, MaxWidth and MaxHeight, if specified as a percentage,
     * are calculated based on the borders of the video including black bars added by Elastic Transcoder, if any.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createFrame() : WatermarkTarget { return new WatermarkTarget("Frame"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

