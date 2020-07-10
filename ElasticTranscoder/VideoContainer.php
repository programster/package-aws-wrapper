<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class VideoContainer
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    public static function createAvi() : VideoContainer { return new VideoContainer("avi"); }
    public static function createDivx() : VideoContainer { return new VideoContainer("divx"); }
    public static function createFlv() : VideoContainer { return new VideoContainer("flv"); }
    public static function createMkv() : VideoContainer { return new VideoContainer("mkv"); }
    public static function createMov() : VideoContainer { return new VideoContainer("mov"); }
    public static function createFmp4() : VideoContainer { return new VideoContainer("fmp4"); }
    public static function createMp4() : VideoContainer { return new VideoContainer("mp4"); }
    public static function createMpeg() : VideoContainer { return new VideoContainer("mpg"); }
    public static function createMpegTs() : VideoContainer { return new VideoContainer("ts"); }
    public static function createMxf() : VideoContainer { return new VideoContainer("mxf"); }
    public static function createOgg() : VideoContainer { return new VideoContainer("ogg"); }
    public static function createOga() : VideoContainer { return new VideoContainer("oga"); }
    public static function createVob() : VideoContainer { return new VideoContainer("vob"); }
    public static function createWav() : VideoContainer { return new VideoContainer("wav"); }
    public static function createWebm() : VideoContainer { return new VideoContainer("webm"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

