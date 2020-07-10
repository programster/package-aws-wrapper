<?php


namespace Programster\AwsWrapper\ElasticTranscoder;


final class CaptionSourceCollection extends \ArrayObject
{
    public function __construct(CaptionSource ...$sources)
    {
        parent::__construct($sources);
    }


    public function append($value)
    {
        if ($value instanceof CaptionSource)
        {
            parent::append($value);
        }
        else
        {
            throw new Exception("Cannot append non CaptionSource to a " . __CLASS__);
        }
    }


    public function offsetSet($index, $newval)
    {
        if ($newval instanceof CaptionSource)
        {
            parent::offsetSet($index, $newval);
        }
        else
        {
            throw new Exception("Cannot add a non CaptionSource value to a " . __CLASS__);
        }
    }
}