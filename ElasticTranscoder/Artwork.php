<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-artwork
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class Artwork implements \JsonSerializable
{
    private $m_arrayForm;


    /**
     *
     * @param string $inputKey - The name of the file to be used as album art. To determine which Amazon S3 bucket
     * contains the specified file, Elastic Transcoder checks the pipeline specified by PipelineId; the InputBucket
     * object in that pipeline identifies the bucket.
     * If the file name includes a prefix, for example, cooking/pie.jpg, include the prefix in the key. If the file
     * isn't in the specified bucket, Elastic Transcoder returns an error.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\ImageFormat $albumArtFormat - jpg or png art.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\PaddingPolicy $paddingPolicy - When you set PaddingPolicy to
     * Pad, Elastic Transcoder may add white bars to the top and bottom and/or left and right sides of the output
     * album art to make the total size of the output art match the values that you specified for MaxWidth and
     * MaxHeight.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\SizingPolicy $sizingPolicy
     *
     * @param int $maxHeight - The maximum height of the output album art in pixels. If you specify a numeric value,
     * enter an even integer between 32 and 3072, inclusive.
     *
     * @param int $maxWidth - The maximum width of the output album art in pixels. If you specify a numeric value,
     * enter an even integer between 32 and 4096, inclusive.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\Encryption|null $encryption - encryption settings if any.
     */
    public function __construct(
        string $inputKey,
        ImageFormat $albumArtFormat,
        PaddingPolicy $paddingPolicy,
        SizingPolicy $sizingPolicy,
        int $maxHeight = 600,
        int $maxWidth = 600,
        ?Encryption  $encryption = null
    )
    {
        $this->m_arrayForm = array(
            'InputKey' => $inputKey,
            'PaddingPolicy' => (string) $paddingPolicy,
            'SizingPolicy' => (string) $sizingPolicy,
            'MaxHeight' => (string) $maxHeight,
            'MaxWidth' => (string) $maxWidth,
        );

        if ($encryption !== null)
        {
            $this->m_arrayForm['Encryption'] = $encryption;
        }
    }
    

    public function jsonSerialize()
    {
        return $this->m_arrayForm;
    }
}

