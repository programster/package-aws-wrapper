<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-createjobplaylist
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class CreateJobPlaylist implements \JsonSerializable
{
    private $m_arrayForm;


    /**
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\PlaylistFormat $format
     *
     * @param string $name - The name that you want Elastic Transcoder to assign to the master playlist,
     *      for example, nyc-vacation.m3u8. If the name includes a / character, the section of the name before
     *      the last / must be identical for all Name objects. If you create more than one master playlist, the
     *      values of all Name objects must be unique.
     *
     * @param array $outputKeys - For each output in this job that you want to include in a master playlist,
     *      the value of the Outputs:Key object.
     *      If your output is not HLS or does not have a segment duration set, the name of the output file is a
     *      concatenation of OutputKeyPrefix and Outputs:Key:
     *          {OutputKeyPrefix}{Outputs:Key}
     *
     *      If your output is HLSv3 and has a segment duration set, or is not included in a playlist, Elastic
     *      Transcoder creates an output playlist file with a file extension of .m3u8, and a series of .ts files
     *      that include a five-digit sequential counter beginning with 00000:
     *          {OutputKeyPrefix}{Outputs:Key}.m3u8
     *          {OutputKeyPrefix}{Outputs:Key}00000.ts
     *
     *      If your output is HLSv4, has a segment duration set, and is included in an HLSv4 playlist, Elastic
     *      Transcoder creates an output playlist file with a file extension of _v4.m3u8. If the output is video,
     *      Elastic Transcoder also creates an output file with an extension of _iframe.m3u8:
     *          {OutputKeyPrefix}Outputs:Key_v4.m3u8
     *          {OutputKeyPrefix}Outputs:Key_iframe.m3u8
     *          {OutputKeyPrefix}Outputs:Key.ts
     *
     *      Elastic Transcoder automatically appends the relevant file extension to the file name. If you include a
     *      file extension in Output Key, the file name will have two extensions.
     *      If you include more than one output in a playlist, any segment duration settings, clip settings, or
     *      caption settings must be the same for all outputs in the playlist. For Smooth playlists, the
     *      Audio:Profile, Video:Profile, and Video:FrameRate to Video:KeyframesMaxDist ratio must be the same
     *      for all outputs.
     *
     *      Elastic Transcoder automatically appends the relevant file extension to the file name (.m3u8 for HLSv3
     *      and HLSv4 playlists, and .ism and .ismc for Smooth playlists). If you include a file extension in Name,
     *      the file name will have two extensions.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\PlayReadyDrm|null $playReadyDrm - The DRM settings, if any,
     * that you want Elastic Transcoder to apply to the output files associated with this playlist.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\HlsContentProtection $hlsContentProection - The HLS content
     * protection settings, if any, that you want Elastic Transcoder to apply to the output files associated with
     * this playlist.
     */
    public function __construct(
        PlaylistFormat $format,
        string $name,
        CreateJobOutputCollection $outputs,
        ?PlayReadyDrm $playReadyDrm = null,
        ?HlsContentProtection $hlsContentProection = null
    )
    {
        $outputKeys = array();

        foreach ($outputs as $output)
        {
            /* @var $output CreateJobOutput */
            $outputKeys[] = $output->getKey();
        }

        $this->m_arrayForm = array(
            'Format' => (string) $format,
            'Name' => $name,
            'OutputKeys' => $outputKeys,
        );

        if ($playReadyDrm !== null)
        {
            $this->m_arrayForm['PlayReadyDrm'] = $playReadyDrm;
        }

        if ($hlsContentProection !== null)
        {
            $this->m_arrayForm[' HlsContentProtection '] = $hlsContentProection;
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

