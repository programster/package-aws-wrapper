<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-presetwatermark
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class PresetWatermark implements \JsonSerializable
{
    private $m_horizontalAlign;
    private $m_horizontalOffset;
    private $m_id;
    private $m_maxHeight;
    private $m_maxWidth;
    private $m_opacity;
    private $m_sizingPolicy;
    private $m_target;
    private $m_verticalAlign;
    private $m_verticalOffset;


    /**
     * Settings for the size, location, and opacity of a watermark to overlay video s with.
     * @param string $id - A unique identifier for the settings for one watermark. The value of Id can be up to 40
     *                      characters long.
     * @param \Programster\AwsWrapper\ElasticTranscoder\HorizontalAlign $horizontalAlign
     * @param \Programster\AwsWrapper\ElasticTranscoder\PixelsOrPercentage $horizontalOffset
     * @param \Programster\AwsWrapper\ElasticTranscoder\PixelsOrPercentage $maxHeight
     * @param \Programster\AwsWrapper\ElasticTranscoder\PixelsOrPercentage $maxWidth
     * @param float $opacity - A percentage that indicates how much you want a watermark to obscure the video in the
     *                         location where it appears. Valid values are 0 (the watermark is invisible) to 100
     *                         (the watermark completely obscures the video in the specified location).
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\SizingPolicy $sizingPolicy
     */
    private function __construct(
        string $id,
        HorizontalAlign $horizontalAlign,
        PixelsOrPercentage $horizontalOffset,
        PixelsOrPercentage $maxHeight,
        PixelsOrPercentage $maxWidth,
        float $opacity,
        \Programster\AwsWrapper\ElasticTranscoder\SizingPolicy $sizingPolicy
    )
    {
        $this->m_value = $value;
    }


    public function toArray()
    {
        return [
            'HorizontalAlign' => (string) $this->m_horizontalAlign,
            'HorizontalOffset' => (string) $this->m_horizontalOffset,
            'Id' => $this->m_id,
            'MaxHeight' => (string) $this->m_maxHeight,
            'MaxWidth' => (string) $this->m_maxWidth,
            'Opacity' => $this->m_opacity,
            'SizingPolicy' => (string) $this->m_sizingPolicy,
            'Target' => (string) $this->m_target,
            'VerticalAlign' => (string) $this->m_verticalAlign,
            'VerticalOffset' => (string) $this->m_verticalOffset,
        ];
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }
}

