<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class AspectRatio
{
    private $m_value;

    private function __construct(string $value)
    {
        $this->m_value = $value;
    }

    public static function createAuto() : AspectRatio { return new AspectRatio("auto"); }
    public static function create1by1() : AspectRatio { return new AspectRatio("1:1"); }
    public static function create4by3() : AspectRatio { return new AspectRatio("4:3"); }
    public static function create3by2() : AspectRatio { return new AspectRatio("3:2"); }
    public static function create16by9() : AspectRatio { return new AspectRatio("16:9"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

