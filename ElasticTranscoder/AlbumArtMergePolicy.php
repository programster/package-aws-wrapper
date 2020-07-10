<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class AlbumArtMergePolicy
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    /**
     * The specified album art replaces any existing album art.
     * @return \Programster\AwsWrapper\ElasticTranscoder\AlbumArtMergePolicy
     */
    public static function createReplace() : AlbumArtMergePolicy { return new AlbumArtMergePolicy("Replace"); }


    /**
     * The specified album art is placed in front of any existing album art.
     * @return \Programster\AwsWrapper\ElasticTranscoder\AlbumArtMergePolicy
     */
    public static function createPrepend() : AlbumArtMergePolicy { return new AlbumArtMergePolicy("Prepend"); }


    /**
     * The specified album art is placed after any existing album art.
     * @return \Programster\AwsWrapper\ElasticTranscoder\AlbumArtMergePolicy
     */
    public static function createAppend() : AlbumArtMergePolicy { return new AlbumArtMergePolicy("Append"); }


    /**
     * If the original input file contains artwork, Elastic Transcoder uses that artwork for the output. If the original input does not contain artwork, Elastic Transcoder uses the specified album art file.
     * @return \Programster\AwsWrapper\ElasticTranscoder\AlbumArtMergePolicy
     */
    public static function createFallback() : AlbumArtMergePolicy { return new AlbumArtMergePolicy("Fallback"); }



    public function __toString()
    {
        return $this->m_value;
    }
}

