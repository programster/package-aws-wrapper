<?php

/*
 * A collection of PresetWatermark objects.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


final class WatermarkCollection extends \ArrayObject
{
    public function __construct(PresetWatermark ...$watermarks)
    {
        parent::__construct($watermarks);
    }


    public function append($value)
    {
        if ($value instanceof PresetWatermark)
        {
            parent::append($value);
        }
        else
        {
            throw new Exception("Cannot append non PresetWatermark to a " . __CLASS__);
        }
    }


    public function offsetSet($index, $newval)
    {
        if ($newval instanceof PresetWatermark)
        {
            parent::offsetSet($index, $newval);
        }
        else
        {
            throw new Exception("Cannot add a non PresetWatermark value to a " . __CLASS__);
        }
    }
}