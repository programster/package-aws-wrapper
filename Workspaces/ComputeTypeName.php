<?php

/*
 * An "enum" for the ComputeTypeName
 */

class ComputeTypeName
{
    private $m_type;


    private function __construct(string $type)
    {
        $this->m_type = $type;
    }


    public static function createValue() : ComputeTypeName
    {
        return new ComputeTypeName('VALUE');
    }


    public static function createStandard() : ComputeTypeName
    {
        return new ComputeTypeName('STANDARD');
    }


    public static function createPerformance() : ComputeTypeName
    {
        return new ComputeTypeName('PERFORMANCE');
    }


    public static function createPower() : ComputeTypeName
    {
        return new ComputeTypeName('POWER');
    }


    public static function createGraphics() : ComputeTypeName
    {
        return new ComputeTypeName('GRAPHICS');
    }


    public static function createPowerPro() : ComputeTypeName
    {
        return new ComputeTypeName('POWERPRO');
    }


    public static function createGraphicsPro() : ComputeTypeName
    {
        return new ComputeTypeName('GRAPHICSPRO');
    }


    public function __toString()
    {
        return $this->m_type;
    }
}
