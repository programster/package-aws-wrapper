<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class AudioCodecOptions implements \JsonSerializable
{
    private $m_options;


    private function __construct(array $options)
    {
        $this->m_options = $options;
    }


    public static function createForAac(AudioProfile $profile) : AudioCodecOptions
    {
        return new AudioCodecOptions([
            'Profile' => (string)$profile,
        ]);
    }


    public static function createForFlac(AudioBitDepth $bitDepth) : AudioCodecOptions
    {
        return new AudioCodecOptions([
            'BitDepth' => $bitDepth,
        ]);
    }

    public static function createForMp2() : AudioCodec
    {
        return new AudioCodecOptions([]);
    }


    public static function createForMp3() : AudioCodec
    {
        return new AudioCodecOptions([]);
    }


    /**
     * Create audio codec options for a PCM codec.
     * @param \Programster\AwsWrapper\ElasticTranscoder\AudioBitDepth $bitDepth
     * @param bool $useLittleEndianBitOrder - If set to true, will use LittleEndian order
     * @param type $signed
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioCodecOptions
     */
    public static function createForPcm(
        AudioBitDepth $bitDepth,
        bool $useLittleEndianBitOrder,
        bool $signed
    ) : AudioCodecOptions
    {
        $options = AudioCodecOptions([
            'BitDepth' => (string) $bitDepth,
            'Signed' => $signed,
        ]);

        if ($useLittleEndianBitOrder)
        {
            $options['BitOrder'] = "LittleEndian";
        }

        if ($signed)
        {
            $options['Signed'] = "Signed";
        }

        return $options;
    }


    public function toArray() : array
    {
        return $this->m_options;
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }
}

