<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class VideoCodecOptions implements \JsonSerializable
{
    private $m_arrayForm;


    private function __construct(array $options)
    {
        $this->m_arrayForm = $options;
    }


    /**
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\VideoCodecProfile $profile
     * @param \Programster\AwsWrapper\ElasticTranscoder\H264Level $h264Level
     *
     * @param int $maxReferenceFrames - The maximum number of previously decoded frames to use as a reference for
     *      decoding future frames. Valid values are integers 0 through 16, but we recommend that you not use a value
     *      greater than the following:
     *      Min(Floor(Maximum decoded picture buffer in macroblocks * 256 / (Width in pixels * Height in pixels)), 16)
     *
     * @param int $maxBitRate - The maximum number of bits per second in a video buffer; the size of the buffer is
     *      specified by BufferSize. Specify a value between 16 and 62,500. You can reduce the
     *      bandwidth required to stream a video by reducing the maximum bit rate, but this also
     *      reduces the quality of the video.
     *
     * @param int $bufferSize - The maximum number of bits in any x seconds of the output video. This window is
     *      commonly 10 seconds, the standard segment duration when you're using FMP4 or MPEG-TS for the container
     *      type of the output video. Specify an integer greater than 0. If you specify MaxBitRate and omit BufferSize,
     *      Elastic Transcoder sets BufferSize to 10 times the value of MaxBitRate.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\ChromaSubsampling $chromaSubsampling
     * @param \Programster\AwsWrapper\ElasticTranscoder\InterlacedMode|null $interlacedMode
     * @param \Programster\AwsWrapper\ElasticTranscoder\ColorSpaceConversionMode|null $colorSpaceConversionMode
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoCodecOptions
     */
    public static function createForH264(
        VideoCodecProfile $profile,
        H264Level $h264Level,
        int $maxReferenceFrames,
        ?ChromaSubsampling $chromaSubsampling,
        ?int $maxBitRate,
        ?int $bufferSize,
        ?InterlacedMode $interlacedMode,
        ?ColorSpaceConversionMode $colorSpaceConversionMode
    ) : VideoCodecOptions
    {
        $options = array(
            'Profile' => (string) $profile,
        );

        $options['Level'] = (string) $h264Level;
        $clampedMaxReferenceFrames = \Programster\CoreLibs\Core::clampValue($maxReferenceFrames, 16, 0);
        $options['MaxReferenceFrames'] = (string) $clampedMaxReferenceFrames;

        if ($chromaSubsampling !== null)
        {
            $options['ChromaSubsampling'] = (string)$chromaSubsampling;
        }

        if ($maxBitRate !== null)
        {
            $options['MaxBitRate'] = $maxBitRate;
        }

        if ($bufferSize !== null)
        {
            $options['BufferSize'] = $bufferSize;
        }

        if ($interlacedMode !== null)
        {
            $options['InterlacedMode'] = (string) $interlacedMode;
        }

        if ($colorSpaceConversionMode !== null)
        {
            $options['ColorSpaceConversionMode'] = (string) $colorSpaceConversionMode;
        }

        return new VideoCodecOptions($options);
    }


    /**
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\VideoCodecProfile $profile
     * @param \Programster\AwsWrapper\ElasticTranscoder\ChromaSubsampling $chromaSubsampling
     *
     * @param int|null $maxBitRate - The maximum number of bits per second in a video buffer; the size of the buffer is
     *      specified by BufferSize. Specify a value between 16 and 62,500. You can reduce the bandwidth required to
     *      stream a video by reducing the maximum bit rate, but this also reduces the quality of the video.
     *
     * @param int|null $bufferSize - Optionally specify the maximum number of bits in any x seconds of the output video.
     *      This window is commonly 10 seconds, the standard segment duration when you're using FMP4 or MPEG-TS for the
     *      container type of the output video. Specify an integer greater than 0. If you specify MaxBitRate and omit
     *      BufferSize, Elastic Transcoder sets BufferSize to 10 times the value of MaxBitRate.
     *
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoCodecOptions
     */
    public static function createForVp8orVp9(
        VideoCodecProfile $profile,
        ChromaSubsampling $chromaSubsampling,
        ?int $maxBitRate,
        ?int $bufferSize
    ) : VideoCodecOptions
    {
        $options = array(
            'Profile' => (string) $profile,
            'ChromaSubsampling' => $chromaSubsampling
        );

        if ($maxBitRate !== null)
        {
            $options['MaxBitRate'] = $maxBitRate;
        }

        if ($bufferSize !== null)
        {
            $options['BufferSize'] = $bufferSize;
        }

        return new VideoCodecOptions($options);
    }


    /**
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\ChromaSubsampling $chromaSubsampling
     *
     * @param int|null $maxBitRate - The maximum number of bits per second in a video buffer; the size of the buffer is
     *      specified by BufferSize. Specify a value between 16 and 62,500. You can reduce the bandwidth required to
     *      stream a video by reducing the maximum bit rate, but this also reduces the quality of the video.
     *
     * @param int|null $bufferSize - Optionally specify the maximum number of bits in any x seconds of the output video.
     *      This window is commonly 10 seconds, the standard segment duration when you're using FMP4 or MPEG-TS for the
     *      container type of the output video. Specify an integer greater than 0. If you specify MaxBitRate and omit
     *      BufferSize, Elastic Transcoder sets BufferSize to 10 times the value of MaxBitRate.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\InterlacedMode|null $interlacedMode
     * @param \Programster\AwsWrapper\ElasticTranscoder\ColorSpaceConversionMode|null $colorSpaceConversionMode
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoCodecOptions
     */
    public static function createForMpeg2(
        ChromaSubsampling $chromaSubsampling,
        ?int $maxBitRate,
        ?int $bufferSize,
        ?InterlacedMode $interlacedMode,
        ?ColorSpaceConversionMode $colorSpaceConversionMode
    ) : VideoCodecOptions
    {
        $options = array(
            'ChromaSubsampling' => $chromaSubsampling
        );

        if ($maxBitRate !== null)
        {
            $options['MaxBitRate'] = $maxBitRate;
        }

        if ($bufferSize !== null)
        {
            $options['BufferSize'] = $bufferSize;
        }

        if ($interlacedMode !== null)
        {
            $options['InterlacedMode'] = (string) $interlacedMode;
        }

        if ($colorSpaceConversionMode !== null)
        {
            $options['ColorSpaceConversionMode'] = (string) $colorSpaceConversionMode;
        }

        return new VideoCodecOptions($options);
    }


    public static function createForGif(int $loopCount) : VideoCodecOptions
    {
        $options = array('LoopCount' => $loopCount);
        return new VideoCodecOptions($options);
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

