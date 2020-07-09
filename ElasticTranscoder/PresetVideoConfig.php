<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-videoparameters
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class PresetVideoConfig implements \JsonSerializable
{
    private $m_bitRate;
    private $m_codec;
    private $m_codecOptions;
    private $m_maxWidth;
    private $m_maxHeight;
    private $m_sizingPolicy;
    private $m_paddingPolicy;
    private $m_displayAspectRatio;
    private $m_framerate;
    private $m_maxFrameRate;


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
        ?VideoFrameRate $videoFrameRate,
        ?VideoMaxFrameRate $maxFrameRate,
        ?bool $fixedGop,
        PresetWatermark ...$waterMarks
    )
    {
        if ($bitRate !== null)
        {
            $this->m_bitRate = $bitRate;
        }
        else
        {
            $this->m_bitRate = "auto";
        }

        if ($videoFrameRate === null)
        {
            $videoFrameRate = VideoFrameRate::createAuto();
        }

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

        if ($fixedGop !== null)
        {
            if (!in_array((string) $codec, ["h264", "mpeg2", "vp8"]))
            {
                throw new Exception("Cannot set fixed GOP on container that is not h264, mpeg2, or vp8");
            }

            $this->m_fixedGop = $fixedGop;
        }

        $this->m_codec = $codec;
        $this->m_codecOptions = $codecOptions;
        $this->m_maxHeight = \Programster\CoreLibs\Core::clampValue($maxHeight, 96, 3072);
        $this->m_maxWidth = $maxWidth;
        $this->m_paddingPolicy = $paddingPolicy;
        $this->m_sizingPolicy = $sizingPolicy;
        $this->m_framerate = $videoFrameRate;
        $this->m_maxFrameRate = $maxFrameRate;
        $this->m_keyframesMaxDist = $codec->getKeyFramesMaxDist();
    }


    public function toArray() : array
    {
        $arrayForm = array(
            'BitRate' => $this->m_bitRate,
            'Codec' => (string) $this->m_codec,
            'CodecOptions' => $this->m_codecOptions,
            'DisplayAspectRatio' => (string) $this->m_displayAspectRatio,
            'FrameRate' => (string) $this->m_framerate,
            'MaxFrameRate' => (string)$this->m_maxFrameRate,
            'MaxHeight' => $this->m_maxHeight,
            'MaxWidth' => $this->m_maxWidth,
            'PaddingPolicy' => (string)$this->m_paddingPolicy,
            'SizingPolicy' => (string)$this->m_sizingPolicy,
        );

        if ($this->m_codec->getKeyFramesMaxDist() !== null)
        {
            $arrayForm['KeyframesMaxDist'] = $this->m_codec->getKeyFramesMaxDist();
        }

        if ($this->m_fixedGop !== null)
        {
            $arrayForm['FixedGOP'] = $this->m_fixedGop;
        }

        return $arrayForm;
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }
}

