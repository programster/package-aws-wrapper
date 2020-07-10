<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class PresetThumbnailConfig implements \JsonSerializable
{
    private $m_format;
    private $m_interval;
    private $m_maxHeight;
    private $m_maxWidth;
    private $m_paddingPolicy;
    private $m_sizingPolicy;


    /**
     * A configuration for thumbnails
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-thumbnails
     * @param \Programster\AwsWrapper\ElasticTranscoder\AspectRatio $aspectRatio
     * @param \Programster\AwsWrapper\ElasticTranscoder\ImageFormat $format
     * @param int $interval - The approximate number of seconds between thumbnails. Specify an integer value.
     * @param int $maxHeight - The maximum height of thumbnails in pixels. If you specify auto, Elastic Transcoder
     *                          uses 1080 (Full HD) as the default value. If you specify a numeric value, enter an even
     *                          integer between 32 and 3072.
     * @param int $maxWidth - The maximum width of thumbnails in pixels. If you specify auto, Elastic Transcoder uses
     *                        1920 (Full HD) as the default value. If you specify a numeric value, enter an even
     *                        integer between 32 and 4096.
     * @param \Programster\AwsWrapper\ElasticTranscoder\PaddingPolicy $paddingPolicy
     * @param type $resolution
     * @param type $sizingPolicy
     */
    public function __construct(
        ImageFormat $format,
        int $interval,
        int $maxHeight,
        int $maxWidth,
        PaddingPolicy $paddingPolicy,
        SizingPolicy $sizingPolicy
    )
    {
        $this->m_format = $format;
        $this->m_interval = $interval;
        $this->m_maxHeight = $maxHeight;
        $this->m_maxWidth = $maxWidth;
        $this->m_paddingPolicy = $paddingPolicy;
        $this->m_sizingPolicy = $sizingPolicy;
    }


    public function toArray() : array
    {
        return [
            'Format' => (string) $this->m_format,
            'Interval' => (string)$this->m_interval,
            'MaxHeight' => (string)$this->m_maxHeight,
            'MaxWidth' => (string)$this->m_maxWidth,
            'PaddingPolicy' => (string)$this->m_paddingPolicy,
            'SizingPolicy' => (string)$this->m_sizingPolicy,
        ];
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }
}

