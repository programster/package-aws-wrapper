<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class VideoMaxFrameRate
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    public static function createAuto() : VideoFrameRate { return new VideoFrameRate("auto"); }
    public static function create10() : VideoFrameRate { return new VideoFrameRate("10"); }
    public static function create15() : VideoFrameRate { return new VideoFrameRate("15"); }

    /**
     * Create a framerate for 23.97 frames per second
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoFrameRate
     */
    public static function create23_97() : VideoFrameRate { return new VideoFrameRate("23.97"); }
    public static function create24() : VideoFrameRate { return new VideoFrameRate("24"); }
    public static function create25() : VideoFrameRate { return new VideoFrameRate("25"); }

    /**
     * Create a framerate for 29.97 frames per second
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoFrameRate
     */
    public static function create29_97() : VideoFrameRate { return new VideoFrameRate("29.97"); }
    public static function create30() : VideoFrameRate { return new VideoFrameRate("30"); }
    public static function create60() : VideoFrameRate { return new VideoFrameRate("60"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

