<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class CaptionSource implements \JsonSerializable
{
    private $m_arrayForm;


    /**
     * Create a caption source
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-captionsource
     *
     * @param string $key - The name of the sidecar caption file that you want Elastic Transcoder to include in the
     *                      output file.
     *
     * @param string $label - The label of the caption shown in the player when choosing a language. We recommend that
     *                        you put the caption language name here, in the language of the captions.
     *
     * @param string $language - A string that specifies the language of the caption. If you specified multiple
     *                          inputs with captions, the caption language must match in order to be included in the
     *                          output. Specify this as one of:
     *                              - 2-character ISO 639-1 code
     *                              - 3-character ISO 639-2 code
     *
     * @param string $timeOffset - For clip generation or captions that do not start at the same time as the
     *                             associated video file, the TimeOffset tells Elastic Transcoder how much of the
     *                             video to encode before including captions.
     *                             Specify the TimeOffset in the form [+-]SS.sss or [+-]HH:mm:SS.ss.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\Encryption|null $encryption
     */
    private function __construct(
        string $key,
        string $label,
        string $language,
        string $timeOffset,
        ?Encryption $encryption
    )
    {
        $this->m_arrayForm = array(
            'Key' => $key,
            'Label' => $label,
            'Language' => $language,
            'TimeOffset' => $timeOffset
        );

        if ($encryption !== null)
        {
            $this->m_arrayForm['Encryption'] = $encryption;
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

