<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class PlaylistFormat
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    public static function createHlsV3() : PlaylistFormat { return new PlaylistFormat("HLSv3"); }
    public static function createHlsV4() : PlaylistFormat { return new PlaylistFormat("HLSv4"); }
    public static function createSmooth() : PlaylistFormat { return new PlaylistFormat("Smooth"); }


    public function __toString()
    {
        return $this->m_value;
    }
}
