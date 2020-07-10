<?php


namespace Programster\AwsWrapper\ElasticTranscoder;


final class CreateJobOutputCollection extends \ArrayObject
{
    public function __construct(CreateJobOutput ...$sources)
    {
        parent::__construct($sources);
    }


    public function append($value)
    {
        if ($value instanceof CreateJobOutput)
        {
            parent::append($value);
        }
        else
        {
            throw new Exception("Cannot append non CreateJobOutput to a " . __CLASS__);
        }
    }


    public function offsetSet($index, $newval)
    {
        if ($newval instanceof CreateJobOutput)
        {
            parent::offsetSet($index, $newval);
        }
        else
        {
            throw new Exception("Cannot add a non CreateJobOutput value to a " . __CLASS__);
        }
    }
}