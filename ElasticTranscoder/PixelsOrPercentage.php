<?php

/*
 * A value that needs to be either the number of pixels, or the percentage.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class PixelsOrPercentage
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    public static function createNumPixels(int $numberOfPixels) : PixelsOrPercentage { return new PixelsOrPercentage("{$numberOfPixels}px"); }
    public static function createPercentage(int $percentage) : PixelsOrPercentage { return new PixelsOrPercentage("{$percentage}%"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

