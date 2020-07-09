<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class ColorSpaceConversionMode
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    public static function createNone() : ColorSpaceConversionMode { return new ColorSpaceConversionMode("None"); }
    public static function createBt709toBt601() : ColorSpaceConversionMode { return new ColorSpaceConversionMode("Bt709toBt601"); }
    public static function createBt601toBt709() : ColorSpaceConversionMode { return new ColorSpaceConversionMode("Bt601toBt709"); }
    public static function createAuto() : ColorSpaceConversionMode { return new ColorSpaceConversionMode("Auto"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

