<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-jobinput
 */


namespace Programster\AwsWrapper\ElasticTranscoder;


class JobInput implements \JsonSerializable
{
    private $m_arrayForm;


    /**
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\AspectRatio|null $aspectRatio
     * @param \Programster\AwsWrapper\ElasticTranscoder\VideoFrameRate|null $frameRate
     * @param string $container
     * @param \Programster\AwsWrapper\ElasticTranscoder\Encryption $encryption
     * @param \Programster\AwsWrapper\ElasticTranscoder\InputCaptions|null $inputCaptions
     * @param \Programster\AwsWrapper\ElasticTranscoder\Programster\AwsWrapper\ElasticTranscoder\InterlacedMode $interlaced
     *
     * @param string $key - The name of the file to transcode. Elsewhere in the body of the JSON block is the the
     *      ID of the pipeline to use for processing the job. The InputBucket object in that pipeline tells
     *      Elastic Transcoder which Amazon S3 bucket to get the file from.
     *      If the file name includes a prefix, such as cooking/lasagna.mpg, include the prefix in the key. If the
     *      file isn't in the specified bucket, Elastic Transcoder returns an error.
     *
     * @param string $resolution
     * @param \Programster\AwsWrapper\ElasticTranscoder\Timespan $timespan
     */
    private function __construct(
        ?AspectRatio $aspectRatio = null,
        ?VideoFrameRate $frameRate = null,
        string $container = "auto", //  3gp, aac, asf, avi, divx, flv, m4a, mkv, mov, mp3, mp4, mpeg, mpeg-ps, mpeg-ts, mxf, ogg, vob, wav, webm,
        Encryption $encryption = null,
        ?InputCaptions $inputCaptions,
        Programster\AwsWrapper\ElasticTranscoder\InterlacedMode $interlaced,
        string $key,

        Timespan $timespan
    )
    {
        $this->m_options['Container'] = $container;
        $this->m_options['FrameRate'] = (string)($frameRate ?? VideoFrameRate::createAuto());
        $this->m_options['AspectRatio'] = (string)($aspectRatio ?? AspectRatio::createAuto());
        $this->m_options['Resolution'] = "auto"; // if this has to have a value of auto, why do they make us set it?

        if ($encryption !== null)
        {
            $this->m_options['Encryption'] = $encryption;
        }

        if ($inputCaptions !== null)
        {
            $this->m_options['InputCaptions'] = $inputCaptions;
        }


        $this->m_arrayForm = $value;
    }


    public function __toString()
    {
        return $this->m_arrayForm;
    }


    public function jsonSerialize()
    {
        return $this->m_options;
    }

}



