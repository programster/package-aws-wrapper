<?php

/*
 * This is the same as setting the maximum video framerate, but unlike that, in which you have to set a value,
 * we can set "auto" to have the framerate just match whatever the input is.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class VideoFrameRate extends VideoMaxFrameRate
{
    public static function createAuto() : VideoFrameRate { return new VideoFrameRate("auto"); }
}

