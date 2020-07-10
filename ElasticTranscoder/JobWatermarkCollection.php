<?php


namespace Programster\AwsWrapper\ElasticTranscoder;


final class JobWatermarkCollection extends \ArrayObject
{
    public function __construct(JobWatermark ...$sources)
    {
        parent::__construct($sources);
    }


    public function append($value)
    {
        if ($value instanceof JobWatermark)
        {
            parent::append($value);
        }
        else
        {
            throw new Exception("Cannot append non JobWatermark to a " . __CLASS__);
        }
    }


    public function offsetSet($index, $newval)
    {
        if ($newval instanceof JobWatermark)
        {
            parent::offsetSet($index, $newval);
        }
        else
        {
            throw new Exception("Cannot add a non JobWatermark value to a " . __CLASS__);
        }
    }
}