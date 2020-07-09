<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class HorizontalAlign
{
    private $m_value;

    private function __construct(string $value)
    {
        $this->m_value = $value;
    }

    public static function createLeft() : HorizontalAlign { return new HorizontalAlign("Left"); }
    public static function createRight() : HorizontalAlign { return new HorizontalAlign("Right"); }
    public static function createCenter() : HorizontalAlign { return new HorizontalAlign("Center"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

