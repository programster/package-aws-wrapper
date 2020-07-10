<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-jobalbumart
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class JobAlbumArt implements \JsonSerializable
{
    private $m_arrayForm;


    public function __construct(AlbumArtMergePolicy $mergePolicy, Artwork ...$artworks)
    {
        $this->m_arrayForm = array(
            'MergePolicy' => (string)$mergePolicy,
            'Artwork' => $artworks
        );
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }
}

