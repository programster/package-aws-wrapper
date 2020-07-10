<?php


namespace Programster\AwsWrapper\ElasticTranscoder;


final class ClipCollection extends \ArrayObject
{
    public function __construct(Clip ...$clips)
    {
        parent::__construct($clips);
    }


    public function append($value)
    {
        if ($value instanceof Clip)
        {
            parent::append($value);
        }
        else
        {
            throw new Exception("Cannot append non Clip to a " . __CLASS__);
        }
    }


    public function offsetSet($index, $newval)
    {
        if ($newval instanceof Clip)
        {
            parent::offsetSet($index, $newval);
        }
        else
        {
            throw new Exception("Cannot add a non Clip value to a " . __CLASS__);
        }
    }
}