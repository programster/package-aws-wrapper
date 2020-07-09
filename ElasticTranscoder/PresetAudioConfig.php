<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-audioparameters
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class PresetAudioConfig implements \JsonSerializable
{
    private $m_audioPackingMode;
    private $m_bitRate;
    private $m_channels;
    private $m_audioCodec;
    private $m_audioCodecOptions;
    private $m_sampleRate;


    /**
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\AudioPackingMode $audioPackingMode
     * @param int $bitRate - The bit rate of the audio stream in the output file, in kilobits/second. Enter an integer
     *                       between 64 and 320, inclusive.
     * @param AudioChannels $channels - specify the number of channels between 0 and 2. If provide a value of null, then
     *                                  will automatically match the number of the input file.
     * @param \Programster\AwsWrapper\ElasticTranscoder\AudioCodec $codec
     * @param \Programster\AwsWrapper\ElasticTranscoder\AudioCodecOptions
     * @param type $sampleRate
     */
    public function __construct(
        AudioPackingMode $audioPackingMode,
        int $bitRate,
        AudioChannels $channels,
        AudioCodec $codec,
        AudioCodecOptions $audioCodecOptions,
        AudioSampleRate $sampleRate
    )
    {
        $this->m_channels = $channels ?? "auto";
        $this->m_audioPackingMode = $audioPackingMode;
        $this->m_bitRate = \Programster\CoreLibs\Core::clampValue($bitRate, 64, 320);
        $this->m_audioCodec = $codec;
        $this->m_audioCodecOptions = $audioCodecOptions;
        $this->m_sampleRate = $sampleRate;
    }


    public function toArray() : array
    {
        $arrayForm = array(
            'AudioPackingMode' => $this->m_audioPackingMode,
            'BitRate' => $this->m_bitRate,
            'Channels' => $this->m_channels,
            'Codec' => $this->m_audioCodec,
            'CodecOptions' => $this->m_audioCodecOptions,
            'SampleRate' => $this->m_sampleRate,
        );

        return $arrayForm;
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }
}

