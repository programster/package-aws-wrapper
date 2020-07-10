<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-createjoboutput
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class CreateJobOutput implements \JsonSerializable
{
    private $m_key;
    private $m_arrayForm;


    /**
     *
     * @param string $key - The name to assign to the transcoded file. Elastic Transcoder saves the file in the Amazon
     * S3 bucket specified by the OutputBucket object in the pipeline that is specified by the pipeline ID. If a
     * file with the specified name already exists in the output bucket, the job fails.
     *
     * @param string $presetId -  The Id of the preset to use for this job. The preset determines the audio, video,
     * and thumbnail settings that Elastic Transcoder uses for transcoding.
     *
     * @param string|null $segmentDuration - (Outputs in Fragmented MP4 or MPEG-TS format only.
     * If you specify a preset in PresetId for which the value of Container is fmp4 (Fragmented MP4) or ts (MPEG-TS),
     * SegmentDuration is the target maximum duration of each segment in seconds. For HLSv3 format playlists, each
     * media segment is stored in a separate .ts file. For HLSv4 and Smooth playlists, all media segments for an output
     * are stored in a single file. Each segment is approximately the length of the SegmentDuration, though individual
     * segments might be shorter or longer.
     * The range of valid values is 1 to 60 seconds. If the duration of the video is not evenly divisible by
     * SegmentDuration, the duration of the last segment is the remainder of total length/SegmentDuration.
     * Elastic Transcoder creates an output-specific playlist for each output HLS output that you specify in OutputKeys.
     * To add an output to the master playlist for this job, include it in the OutputKeys of the associated playlist.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\JobAlbumArt|null $albumArt - Information about the album art
     * that you want Elastic Transcoder to add to the file during transcoding. You can specify up to twenty album
     * artworks for each output. Settings for each artwork must be defined in the job for the current output.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\Captions|null $captions -
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-createjoboutput
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\Rotate|null $rotate
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\ClipCollection|null $composition - You can create an output
     * file that contains an excerpt from the input file. This excerpt, called a clip, can come from the beginning,
     * middle, or end of the file. The Composition object contains settings for the clips that make up an output file.
     * For the current release, you can only specify settings for a single clip per output file. The Composition object
     * cannot be null.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\Encryption|null $encryption - You can specify encryption
     * settings for any output files that you want to use for a transcoding job. This includes the output file and any
     * watermarks, thumbnails, album art, or captions that you want to use. You must specify encryption settings for
     * each file individually.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\Encryption|null $thumbnailEncryption - The encryption settings,
     * if any, that you want Elastic Transcoder to apply to your thumbnail.
     *
     * @param string $thumbnailPattern - Whether you want Elastic Transcoder to create thumbnails for your videos and,
     * if so, how you want Elastic Transcoder to name the files.
     * If you don't want Elastic Transcoder to create thumbnails, specify "".
     * If you do want Elastic Transcoder to create thumbnails, specify the information that you want to include in the
     * file name for each thumbnail. You can specify the following values in any sequence:
     *      - {count} (Required): If you want to create thumbnails, you must include {count} in the ThumbnailPattern
     *          object. Wherever you specify {count}, Elastic Transcoder adds a five-digit sequence number
     *          (beginning with 00001) to thumbnail file names. The number indicates where a given thumbnail appears
     *          in the sequence of thumbnails for a transcoded file.
     *          If you specify a literal value and/or {resolution} but you omit {count}, Elastic Transcoder returns a
     *          validation error and does not create the job.
     *      - Literal values (Optional): You can specify literal values anywhere in the ThumbnailPattern object.
     *          For example, you can include them as a file name prefix or as a delimiter between {resolution} and
     *          {count}.
     *      - {resolution} (Optional): If you want Elastic Transcoder to include the resolution in the file name,
     *          include {resolution} in the ThumbnailPattern object.
     *
     * When creating thumbnails, Elastic Transcoder automatically saves the files in the format (.jpg or .png)
     * that appears in the preset that you specified in the PresetID value of CreateJobOutput. Elastic Transcoder
     * also appends the applicable file name extension.
     *
     * @param \Programster\AwsWrapper\ElasticTranscoder\JobWatermarkCollection|null $watermarks - Information about
     * the watermarks that you want Elastic Transcoder to add to the video during transcoding. You can specify up to
     * four watermarks for each output. Settings for each watermark must be defined in the preset for the current
     * output.
     */
    public function __construct(
        string $key,
        string $presetId, // The ID of the preset to use for the job
        ?string $segmentDuration,
        ?JobAlbumArt $albumArt = null,
        ?Captions  $captions = null, // 2
        ?Rotate $rotate = null,
        ?ClipCollection $composition = null,
        ?Encryption $encryption = null,
        ?Encryption $thumbnailEncryption = null,
        string $thumbnailPattern = "",
        ?JobWatermarkCollection $watermarks = null
    )
    {
        $this->m_key = $key;

        $this->m_arrayForm = array(
            'Key' => $key,
            'PresetId' => $presetId,
            'ThumbnailPattern' => $thumbnailPattern,
        );

        if ($segmentDuration !== null) { $this->m_arrayForm['SegmentDuration'] = (string)$segmentDuration; }
        if ($albumArt !== null) { $this->m_arrayForm['AlbumArt'] = $albumArt; }
        if ($captions !== null) { $this->m_arrayForm['Captions'] = $captions; }
        if ($rotate !== null) { $this->m_arrayForm['Rotate'] = (string)$rotate; }
        if ($composition !== null && count($composition) > 0) { $this->m_arrayForm['Composition'] = $composition->getArrayCopy(); }
        if ($encryption !== null) { $this->m_arrayForm['Encryption'] = $encryption; }
        if ($thumbnailEncryption !== null) { $this->m_arrayForm['ThumbnailEncryption'] = $thumbnailEncryption; }
        if ($watermarks !== null && count($watermarks) > 0) { $this->m_arrayForm['Watermarks'] = $watermarks->getArrayCopy(); }
    }


    public function toArray()
    {
        return $this->m_arrayForm;
    }


    public function jsonSerialize()
    {
        return $this->m_arrayForm;
    }


    # Accessors
    public function getKey() : string { return $this->m_key; }
}

