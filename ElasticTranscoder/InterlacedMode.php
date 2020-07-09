<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class InterlacedMode
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    /**
     * No interlacing, top to bottom
     * @return \Programster\AwsWrapper\ElasticTranscoder\InterlacedMode
     */
    public static function createProgressive() : InterlacedMode { return new InterlacedMode("Progressive"); }


    /**
     * Top field first
     * @return \Programster\AwsWrapper\ElasticTranscoder\InterlacedMode
     */
    public static function createTopFirst() : InterlacedMode { return new InterlacedMode("TopFirst"); }


    /**
     * Bottom field first
     * @return \Programster\AwsWrapper\ElasticTranscoder\InterlacedMode
     */
    public static function createBottomFirst() : InterlacedMode { return new InterlacedMode("BottomFirst"); }


    /**
     * Transcoder will interlace the output.
     * @return \Programster\AwsWrapper\ElasticTranscoder\InterlacedMode
     */
    public static function createAuto() : InterlacedMode { return new InterlacedMode("Auto"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

