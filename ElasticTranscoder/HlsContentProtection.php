<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-hlscontentprotection
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class HlsContentProtection implements \JsonSerializable
{
    private $m_arrayForm;


    private function __construct(
        ?string $initializationVector,
        ?string $key,
        ?string $keyMd5,
        ?string $keyStoragePolicy,
        ?string $licenseAcquisitionUrl
    )
    {
        $this->m_arrayForm = array(
            'Method' => "aes-128",
        );

        if ($key !== null) { $this->m_arrayForm['Key'] = $key; }
        if ($keyMd5 !== null) { $this->m_arrayForm['KeyMd5'] = $keyMd5; }
        if ($initializationVector !== null) { $this->m_arrayForm['InitializationVector'] = $initializationVector; }
        if ($licenseAcquisitionUrl !== null) { $this->m_arrayForm['LicenseAcquisitionUrl'] = $licenseAcquisitionUrl; }

        $this->m_arrayForm['KeyMd5'] = $licenseAcquisitionUrl;
        $this->m_arrayForm['KeyStoragePolicy'] = $licenseAcquisitionUrl;
        $this->m_arrayForm['InitializationVector'] = $initializationVector;
        $this->m_arrayForm['LicenseAcquisitionUrl'] = $licenseAcquisitionUrl;
    }


    public static function createWithElasticTranscoderGeneratedKey() : HlsContentProtection
    {
        return new HlsContentProtection(null, null, null, 'WithVariantPlaylists', null);
    }


    /**
     *
     * @param string $initializationVector - The series of random bits created by a random bit generator, unique for
     *      every encryption operation, that you want Elastic Transcoder to use to encrypt your output files.
     *      The initialization vector must be base64-encoded, and it must be exactly 16 bytes before being
     *      base64-encoded.
     *
     * @param string $key - If you choose to supply your own key, you must encrypt the key by using AWS KMS.
     *      The key must be base64-encoded, and it must be one of the following bit lengths before being base64-encoded:
     *      128, 192, or 256.
     *
     * @param string $keyMd5 - The MD5 digest of the key that you want Elastic Transcoder to use to encrypt your
     *      output file, and that you want Elastic Transcoder to use as a checksum to make sure your key was not
     *      corrupted in transit. The key MD5 must be base64-encoded, and it must be exactly 16 bytes before
     *      being base64- encoded.
     *
     * @param string|null $licenseAcquisitionUrl - The location of the license key required to decrypt your HLS
     *      playlist. The URL must be an absolute path, and is referenced in the URI attribute of the EXT-X-KEY
     *      metadata tag in the playlist file.
     * @return \Programster\AwsWrapper\ElasticTranscoder\HlsContentProtection
     */
    public static function createWithCustomKey(
        string $initializationVector,
        string $key,
        string $keyMd5,
        ?string $licenseAcquisitionUrl
    )
    {
        return new HlsContentProtection($initializationVector, $key, $keyMd5, null, $licenseAcquisitionUrl);
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

