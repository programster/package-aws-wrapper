<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-jobinput
 */


namespace Programster\AwsWrapper\ElasticTranscoder;


class CreateJobInput implements \JsonSerializable
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
     * @param \Programster\AwsWrapper\ElasticTranscoder\Timespan $composition
     */
    public function __construct(
        string $key,
        ?AspectRatio $aspectRatio = null,
        ?VideoFrameRate $frameRate = null,
        ?JobInputContainer $container = null,
        ?Encryption $encryption = null,
        ?InputCaptions $inputCaptions = null,
        ?Programster\AwsWrapper\ElasticTranscoder\InterlacedMode $interlaced = null,
        ?ClipCollection $composition = null
    )
    {
        $this->m_arrayForm = array();

        $container = $container ?? JobInputContainer::createAuto();
        $frameRate = $frameRate ?? VideoFrameRate::createAuto();
        $aspectRatio = $aspectRatio ?? AspectRatio::createAuto();

        $this->m_arrayForm['Key'] = (string)$key;
        $this->m_arrayForm['Container'] = (string)$container;
        $this->m_arrayForm['FrameRate'] = (string)$frameRate;
        $this->m_arrayForm['AspectRatio'] = (string)$aspectRatio;
        $this->m_arrayForm['Resolution'] = "auto"; // if this has to have a value of auto, why do they make us set it?

        if ($encryption !== null)
        {
            $this->m_arrayForm['Encryption'] = $encryption;
        }

        if ($composition !== null && count($composition) > 0)
        {
            $this->m_arrayForm['Composition'] = $composition->getArrayCopy();
        }

        if ($inputCaptions !== null)
        {
            $this->m_arrayForm['InputCaptions'] = $inputCaptions;
        }
    }


    public function toArray()
    {
        return $this->m_arrayForm;
    }


    public function jsonSerialize()
    {
        return $this->m_arrayForm;
    }

}



