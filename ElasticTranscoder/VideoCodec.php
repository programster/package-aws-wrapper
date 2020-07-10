<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class VideoCodec
{
    private $m_value;
    private $m_fixedGop;
    private $m_keyframesMaxDist;


    /**
     *
     * @param string $value
     * @param int|null $keyframesMaxDist - the maximum number of frames between keyframes.
     */
    private function __construct(string $value, ?bool $fixedGop, ?int $keyframesMaxDist)
    {
        $this->m_keyframesMaxDist = $keyframesMaxDist;
        $this->m_fixedGop = $fixedGop;
        $this->m_value = $value;
    }


    /**
     * Create a video using the h264 codec.
     * @param int $keyframesMaxDist - The maximum number of frames between key frames. Key frames are fully encoded
     *      frames; the frames between key frames are encoded based, in part, on the content of the key frames. The
     *      value is an integer formatted as a string; valid values are between 1 (every frame is a key frame) and
     *      100000, inclusive. A higher value results in higher compression but may also discernibly decrease video
     *      quality.
     *
     *      For Smooth outputs, the FrameRate must have a constant ratio to the KeyframesMaxDist. This allows Smooth
     *      playlists to switch between different quality levels while the file is being played.
     *      For example, an input file can have a FrameRate of 30 with a KeyframesMaxDist of 90. The output file then
     *      needs to have a ratio of 1:3. Valid outputs would have FrameRate of 30, 25, and 10, and KeyframesMaxDist of
     *      90, 75, and 30, respectively.
     *
     * @return \Programster\AwsWrapper\ElasticTranscoder\VideoContainer
     */
    public static function createH264(int $keyframesMaxDist, bool $fixedGop) : VideoCodec
    {
        return new VideoCodec("H.264", $fixedGop, $keyframesMaxDist);
    }


    public static function createMpeg2(int $keyframesMaxDist, ?bool $fixedGop) : VideoCodec
    {
        return new VideoCodec("mpeg2", $fixedGop, $keyframesMaxDist);
    }


    public static function createVp8(int $keyframesMaxDist, ?bool $fixedGop) : VideoCodec
    {
        return new VideoCodec("vp8", $fixedGop, $keyframesMaxDist);
    }


    public static function createVp9(?bool $fixedGop) : VideoCodec
    {
        return new VideoCodec("vp9", $fixedGop, null);
    }


    public static function createGif() : VideoCodec { return new VideoCodec("gif", null); }


    public function __toString()
    {
        return $this->m_value;
    }


    /**
     * Get the keyframes max distance. This value will only be set on the appropriate codecs.
     * @return int|null
     */
    public function getKeyFramesMaxDist() : ?int { return $this->m_keyframesMaxDist; }
    public function getFixedGop() : ?bool { return $this->m_fixedGop; }
}

