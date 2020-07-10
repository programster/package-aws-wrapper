<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class ThumbnailFormat
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    public static function createPng() : ThumbnailFormat { return new ThumbnailFormat("png"); }
    public static function createJpg() : ThumbnailFormat { return new ThumbnailFormat("jpg"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

