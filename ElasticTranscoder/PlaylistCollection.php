<?php

/*
 * A collection of CreateJobPlaylist objects.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


final class PlaylistCollection extends \ArrayObject
{
    public function __construct(CreateJobPlaylist ...$playlists)
    {
        parent::__construct($playlists);
    }


    public function append($value)
    {
        if ($value instanceof CreateJobPlaylist)
        {
            parent::append($value);
        }
        else
        {
            throw new Exception("Cannot append non CreateJobPlaylist to a " . __CLASS__);
        }
    }


    public function offsetSet($index, $newval)
    {
        if ($newval instanceof CreateJobPlaylist)
        {
            parent::offsetSet($index, $newval);
        }
        else
        {
            throw new Exception("Cannot add a non CreateJobPlaylist value to a " . __CLASS__);
        }
    }
}