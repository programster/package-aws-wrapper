<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class VideoMaxFrameRate
{
    protected $m_value;


    protected function __construct(string $value)
    {
        $this->m_value = $value;
    }


    public static function createAuto() : VideoMaxFrameRate { return new VideoMaxFrameRate("auto"); }
    public static function create10() : VideoMaxFrameRate { return new VideoMaxFrameRate("10"); }
    public static function create15() : VideoMaxFrameRate { return new VideoMaxFrameRate("15"); }

    /**
     * Create a framerate for 23.97 frames per second
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoFrameRate
     */
    public static function create23_97() : VideoMaxFrameRate { return new VideoMaxFrameRate("23.97"); }
    public static function create24() : VideoMaxFrameRate { return new VideoMaxFrameRate("24"); }
    public static function create25() : VideoMaxFrameRate { return new VideoMaxFrameRate("25"); }

    /**
     * Create a framerate for 29.97 frames per second
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoFrameRate
     */
    public static function create29_97() : VideoMaxFrameRate { return new VideoMaxFrameRate("29.97"); }
    public static function create30() : VideoMaxFrameRate { return new VideoMaxFrameRate("30"); }
    public static function create60() : VideoMaxFrameRate { return new VideoMaxFrameRate("60"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

