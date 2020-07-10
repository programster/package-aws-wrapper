<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-audioparameters
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class PresetAudioConfig implements \JsonSerializable
{
    private $m_arrayForm = array();


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
        AudioCodec $codec,
        int $bitRate,
        AudioCodecOptions $audioCodecOptions,
        ?AudioSampleRate $sampleRate = null,
        ?AudioPackingMode $audioPackingMode = null,
        ?AudioChannels $channels = null
    )
    {
        $this->m_arrayForm = array(
            'BitRate' => (string)$bitRate,
            'Codec' => (string) $codec,
            'CodecOptions' => $audioCodecOptions->toArray(),
        );

        $sampleRate = $sampleRate ?? AudioSampleRate::createAuto();
        $this->m_arrayForm['SampleRate'] = (string)$sampleRate;

        $channels = $channels ?? AudioChannels::createAuto();
        $this->m_arrayForm['Channels'] = (string)$channels;

        if ($audioPackingMode !== null)
        {
            $this->m_arrayForm['AudioPackingMode'] = (string)$audioPackingMode;
        }
    }


    public function toArray() : array
    {
        return $this->m_arrayForm;
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }
}

