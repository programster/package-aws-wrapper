<?php


namespace Programster\AwsWrapper\ElasticTranscoder;


final class CaptionFormatCollection extends \ArrayObject
{
    public function __construct(CaptionFormat ...$sources)
    {
        parent::__construct($sources);
    }


    public function append($value)
    {
        if ($value instanceof CaptionFormat)
        {
            parent::append($value);
        }
        else
        {
            throw new Exception("Cannot append non CaptionFormat to a " . __CLASS__);
        }
    }


    public function offsetSet($index, $newval)
    {
        if ($newval instanceof CaptionFormat)
        {
            parent::offsetSet($index, $newval);
        }
        else
        {
            throw new Exception("Cannot add a non CaptionFormat value to a " . __CLASS__);
        }
    }
}