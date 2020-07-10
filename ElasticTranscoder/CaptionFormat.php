<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-captionformat
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class CaptionFormat implements \JsonSerializable
{
    private $m_arrayForm;


    /**
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-captionformat
     * @param string $format - The format you specify determines whether Elastic Transcoder generates an embedded or
     * sidecar caption for this output.
     *      Valid Embedded Caption Formats:
     *          For FLAC: None
     *          For MP3: None
     *          For MP4: mov-text
     *          For MPEG-TS: None
     *          For ogg: None
     *          For webm: None
     *      Valid Sidecar Caption Formats: Elastic Transcoder supports dfxp (first div element only), scc, srt,
     *      and webvtt. If you want ttml or smpte-tt compatible captions, specify dfxp as your output format.
     *          For FMP4: dfxp
     *          Non-FMP4 outputs: All sidecar types
     *      fmp4 captions have an extension of .ismt
     *
     * @param string $pattern - The prefix for caption filenames, in the form description-{language}, where:
     *      - description is a description of the video.
     *      - {language} is a literal value that Elastic Transcoder replaces with the two- or three-letter code for
     *        the language of the caption in the output file names.
     *  If you don't include {language} in the file name pattern, Elastic Transcoder automatically appends "{language}"
     *  to the value that you specify for the description. In addition, Elastic Transcoder automatically appends the
     *  count to the end of the segment files. For example, suppose you're transcoding into srt format. When you
     *  enter "Sydney-{language}-sunrise", and the language of the captions is English (en), the name of the first
     *  caption file is be Sydney-en-sunrise00000.srt.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\Encryption|null $encryption
     */
    private function __construct(
        string $format,
        string $pattern,
        ?Encryption $encryption = null
    )
    {
        $this->m_arrayForm = array(
            'Format' => $format,
            'Pattern' => $pattern,
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
