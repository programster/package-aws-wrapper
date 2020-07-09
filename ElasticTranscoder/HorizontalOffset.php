<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class HorizontalOffset
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    public static function createNumPixels(int $numberOfPixels) : HorizontalOffset { return new HorizontalOffset("{$numberOfPixels}px"); }
    public static function createPercentage(int $percentage) : HorizontalOffset { return new HorizontalOffset("{$percentage}%"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

