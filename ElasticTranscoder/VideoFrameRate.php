<?php

/*
 * This is the same as setting the maximum video framerate, but unlike that, in which you have to set a value,
 * we can set "auto" to have the framerate just match whatever the input is.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class VideoFrameRate extends VideoMaxFrameRate
{
    private $m_value;

    public static function createAuto() : VideoMaxFrameRate { return new VideoFrameRate("auto"); }
}

