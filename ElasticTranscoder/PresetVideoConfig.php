<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-videoparameters
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class PresetVideoConfig implements \JsonSerializable
{
    private $m_arrayForm;


    /**
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\VideoCodec $codec
     * @param int $interval
     * @param int $maxHeight - the maximum height of the video. Value must be between 96 and 3072
     * @param int $maxWidth - The maximum width of the output video in pixels. Enter an even integer between 128 and
     *                        4096.
     * @param \Programster\AwsWrapper\ElasticTranscoder\PaddingPolicy $paddingPolicy
     * @param \Programster\AwsWrapper\ElasticTranscoder\SizingPolicy $sizingPolicy
     * @param \Programster\AwsWrapper\ElasticTranscoder\AspectRatio $displayAspectRatio
     * @param int|null $bitRate - The bit rate of the video stream in the output file, in kilobits/second.
     *                            Valid values depend on the values of Level and Profile. If you provide a value of null,
     *                            "auto" will be used and Elastic Transcoder uses the detected bit rate of the input
     *                            source. If you specify an integer we recommend that you specify a value less than
     *                            or equal to the maximum H.264-compliant value listed for your level and profile:
     * Level - Maximum video bit rate in kilobits/second (baseline and main Profile) : maximum video bit rate in kilobits/second (high Profile)
     *      1 - 64 : 80
     *      1b - 128 : 160
     *      1.1 - 192 : 240
     *      1.2 - 384 : 480
     *      1.3 - 768 : 960
     *      2 - 2000 : 2500
     *      3 - 10000 : 12500
     *      3.1 - 14000 : 17500
     *      3.2 - 20000 : 25000
     *      4 - 20000 : 25000
     *      4.1 - 50000 : 62500
     *
     * @param bool|null $fixedGop - Applicable only when the value of Video:Codec is one of H.264, MPEG2, or VP8.
     *                              Whether to use a fixed value for FixedGOP. Valid values are true and false.
     *                               - true: Elastic Transcoder uses the value of KeyframesMaxDist for the distance
     *                                       between key frames (the number of frames in a group of pictures, or GOP).
     *                               - false: The distance between key frames can vary.
     */
    public function __construct(
        VideoContainer $container,
        VideoCodec $codec,
        VideoCodecOptions $codecOptions,
        int $maxHeight,
        int $maxWidth,
        ?int $bitRate,
        PaddingPolicy $paddingPolicy,
        SizingPolicy $sizingPolicy,
        ?VideoFrameRate $videoFrameRate = null,
        ?VideoMaxFrameRate $maxFrameRate = null,
        ?WatermarkCollection $watermarkCollection = null
    )
    {
        $this->m_arrayForm = array();

        switch ((string) $codec)
        {
            case 'vp8':
            case 'vp9':
            {
                if ((string) $container !== 'webm')
                {
                    throw new \Exception("Cannot use vp8/vp9 codec when not using 'webm' container");
                }
            }
            break;

            case 'gif':
            {
                if ((string) $container !== 'gif')
                {
                    throw new \Exception("Cannot use gif codec when not using 'gif' container");
                }
            }
            break;

            case 'mpeg2':
            {
                if ((string) $container !== 'mpg')
                {
                    throw new \Exception("Cannot use mpeg2 codec when not using 'mpg' container");
                }
            }
            break;
        }

        $this->m_arrayForm['FrameRate'] = (string)($videoFrameRate ?? VideoFrameRate::createAuto());

        if ($maxFrameRate !== null)
        {
            $this->m_arrayForm['MaxFrameRate'] = (string)$maxFrameRate;
        }

        $this->m_arrayForm['BitRate'] = ($bitRate !== null) ? (string)$bitRate : "auto";
        $this->m_arrayForm['Codec'] = (string)$codec;
        $this->m_arrayForm['CodecOptions'] = $codecOptions->toArray();
        $this->m_arrayForm['MaxHeight'] = (string)\Programster\CoreLibs\Core::clampValue($maxHeight, 3072, 96);
        $this->m_arrayForm['MaxWidth'] = (string)\Programster\CoreLibs\Core::clampValue($maxWidth, 4096, 128);
        $this->m_arrayForm['PaddingPolicy'] = (string)$paddingPolicy;
        $this->m_arrayForm['SizingPolicy'] = (string)$sizingPolicy;
        $this->m_arrayForm['DisplayAspectRatio'] = "auto";

        if ($codec->getFixedGop() !== null)
        {
            $this->m_arrayForm['FixedGOP'] = ($codec->getFixedGop()) ? "true" : "false";
        }

        if ($watermarkCollection !== null)
        {
            $this->m_arrayForm['Watermarks'] = $this->m_watermarkCollection->getArrayCopy();
        }

        if ($codec->getKeyFramesMaxDist() !== null)
        {
            $this->m_arrayForm['KeyframesMaxDist'] = (string)$codec->getKeyFramesMaxDist();
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

