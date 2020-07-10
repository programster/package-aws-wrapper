<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class ImageFormat
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    public static function createPng() : ImageFormat { return new ImageFormat("png"); }
    public static function createJpg() : ImageFormat { return new ImageFormat("jpg"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

