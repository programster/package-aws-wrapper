<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class CaptionMergePolicy
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    /**
     * Elastic Transcoder transcodes both embedded and sidecar captions into outputs. If captions for a language are
     * embedded in the input file and also appear in a sidecar file, Elastic Transcoder uses the sidecar captions
     * and ignores the embedded captions for that language.
     * @return \Programster\AwsWrapper\ElasticTranscoder\CaptionMergePolicy
     */
    public static function createMergeOverride() : CaptionMergePolicy { return new AudioCodec("MergeOverride"); }


    /**
     * Elastic Transcoder transcodes both embedded and sidecar captions into outputs. If captions for a language
     * are embedded in the input file and also appear in a sidecar file, Elastic Transcoder uses the embedded
     * captions and ignores the sidecar captions for that language. If CaptionSources is empty, Elastic Transcoder
     * omits all sidecar captions from the output files.
     * @return \Programster\AwsWrapper\ElasticTranscoder\CaptionMergePolicy
     */
    public static function createMergeRetain() : CaptionMergePolicy { return new AudioCodec("MergeRetain"); }


    /**
     * Elastic Transcoder transcodes only the sidecar captions that you specify in CaptionSources.
     * @return \Programster\AwsWrapper\ElasticTranscoder\CaptionMergePolicy
     */
    public static function createOverride() : CaptionMergePolicy { return new AudioCodec("Override"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

