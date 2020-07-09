<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class VideoCodecProfile
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    /**
     * The profile most commonly used for videoconferencing and for mobile applications.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createBaseline() : VideoCodecProfile { return new VideoCodecProfile("baeline"); }

    /**
     * The profile used for standard-definition digital TV broadcasts.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createMain() : VideoCodecProfile { return new VideoCodecProfile("main"); }

    /**
     * The profile used for high-definition digital TV broadcasts and for Blu-ray discs.
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createHigh() : VideoCodecProfile { return new VideoCodecProfile("high"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

