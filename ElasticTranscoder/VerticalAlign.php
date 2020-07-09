<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class VerticalAlign
{
    private $m_value;

    private function __construct(string $value)
    {
        $this->m_value = $value;
    }

    public static function createTop() : HorizontalAlign { return new HorizontalAlign("Top"); }
    public static function createBottom() : HorizontalAlign { return new HorizontalAlign("Bottom"); }
    public static function createCenter() : HorizontalAlign { return new HorizontalAlign("Center"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

