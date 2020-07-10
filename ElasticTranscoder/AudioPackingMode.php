<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#createpreset
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class AudioPackingMode
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }



    /**
     * This is the default setting the Elastic Transcoder uses when you don't specify an audio packing mode.
     * Thus, this is a good choice if you're unsure.
     * 
     * When you specify SingleTrack, Elastic Transcoder creates a single track for your output. The track can have
     * up to eight channels. Use SingleTrack for all non-mxf containers.
     * The outputs of SingleTrack for a specific channel value and inputs are as follows:
     *      0 channels with any input: Audio omitted from the output
     *      1, 2, or auto channels with no audio input: Audio omitted from the output
     *      1 channel with any input with audio: One track with one channel, downmixed if necessary
     *      2 channels with one track with one channel: One track with two identical channels
     *      2 or auto channels with two tracks with one channel each: One track with two channels
     *      2 or auto channels with one track with two channels: One track with two channels
     *      2 channels with one track with multiple channels: One track with two channels
     *      auto channels with one track with one channel: One track with one channel
     *      auto channels with one track with multiple channels: One track with multiple channels
     *
     * @param int $keyframesMaxDist
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioPackingMode#
     */
    public static function createSingleTrack() : AudioPackingMode { return new AudioPackingMode("SingleTrack"); }


    /**
     * When you specify OneChannelPerTrack, Elastic Transcoder creates a new track for every channel in your output.
     * Your output can have up to eight single-channel tracks.
     * The outputs of OneChannelPerTrack for a specific channel value and inputs are as follows:
     *      0 channels with any input: Audio omitted from the output
     *      1, 2, or auto channels with no audio input: Audio omitted from the output
     *      1 channel with any input with audio: One track with one channel, downmixed if necessary
     *      2 channels with one track with one channel: Two tracks with one identical channel each
     *      2 or auto channels with two tracks with one channel each: Two tracks with one channel each
     *      2 or auto channels with one track with two channels: Two tracks with one channel each
     *      2 channels with one track with multiple channels: Two tracks with one channel each
     *      auto channels with one track with one channel: One track with one channel
     *      auto channels with one track with multiple channels: Up to eight tracks with one channel each
     *
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioPackingMode
     */
    public static function createOneChannelPerTrack() : AudioPackingMode { return new AudioPackingMode("OneChannelPerTrack"); }


    /**
     * When you specify OneChannelPerTrackWithMosTo8Tracks, Elastic Transcoder creates eight single-channel tracks for
     * your output. All tracks that do not contain audio data from an input channel are MOS, or Mit Out Sound, tracks.
     * The outputs of OneChannelPerTrackWithMosTo8Tracks for a specific channel value and inputs are as follows:
     *      0 channels with any input: Audio omitted from the output
     *      1, 2, or auto channels with no audio input: Audio omitted from the output
     *      1 channel with any input with audio: One track with one channel, downmixed if necessary, plus six MOS tracks
     *      2 channels with one track with one channel: Two tracks with one identical channel each, plus six MOS tracks
     *      2 or auto channels with two tracks with one channel each: Two tracks with one channel each, plus six MOS tracks
     *      2 or auto channels with one track with two channels: Two tracks with one channel each, plus six MOS tracks
     *      2 channels with one track with multiple channels: Two tracks with one channel each, plus six MOS tracks
     *      auto channels with one track with one channel: One track with one channel, plus seven MOS tracks
     *      auto channels with one track with multiple channels: Up to eight tracks with one channel each, plus MOS tracks until there are eight tracks in all
     *
     * @return \Programster\AwsWrapper\ElasticTranscoder\AudioPackingMode
     */
    public static function createOneChannelPerTrackWithMosTo8Tracks() : AudioPackingMode { return new AudioPackingMode("OneChannelPerTrackWithMosTo8Tracks"); }



    public function __toString()
    {
        return $this->m_value;
    }
}

