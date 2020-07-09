<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class ChromaSubsampling
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    /**
     * Samples the chroma information of every other horizontal and every other vertical line,
     * @return \Programster\AwsWrapper\ElasticTranscoder\ChromaSubsampling
     */
    public static function createYuv420p() : ChromaSubsampling { return new ChromaSubsampling("yuv420p"); }


    /**
     * Samples the color information of every horizontal line and every other vertical line.
     * @return \Programster\AwsWrapper\ElasticTranscoder\ChromaSubsampling
     */
    public static function createYuv422p() : ChromaSubsampling { return new ChromaSubsampling("yuv422p"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

