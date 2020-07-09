<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-encryption
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class Encryption implements \JsonSerializable
{
    private $m_mode;
    private $m_initializationVector;
    private $m_key;
    private $m_keyMd5;


    private function __construct(
        string $mode,
        ?string $initializationVector,
        ?string $key,
        ?string $keyMd5
    )
    {
        $this->m_mode = $mode;
        $this->m_initializationVector = $initializationVector;
        $this->m_key = $key;
        $this->m_keyMd5 = $keyMd5;
    }


    /**
     * Amazon S3 creates and manages the keys used for encrypting your files.
     * @return \Programster\AwsWrapper\ElasticTranscoder\ChromaSubsampling
     */
    public static function createS3() : EncryptionMode
    {
        return new EncryptionMode("s3", null, null, null);
    }


    /**
     * Amazon S3 calls the Amazon Key Management Service, which creates and manages the keys that are used for
     * encrypting your files. If you specify s3-aws-kms and you don't want to use the default key, you must add the
     * AWS-KMS key that you want to use to your pipeline.
     * @return \Programster\AwsWrapper\ElasticTranscoder\EncryptionMode
     */
    public static function createS3AwsKms() : EncryptionMode
    {
        return new EncryptionMode("s3-aws-kms", null, null, null);
    }


    /**
     * A padded cipher-block mode of operation originally used for HLS files.
     * 
     * @param string $initializationVector - The series of random bits created by a random bit generator, unique for
     *      every encryption operation, that you used to encrypt your input files or that you want Elastic Transcoder
     *      to use to encrypt your output files. The initialization vector must be base64-encoded, and it must be
     *      exactly 16 bytes long before being base64-encoded.
     *
     * @param string $key - The data encryption key that you want Elastic Transcoder to use to encrypt your output
     *      file, or that was used to encrypt your input file. The key must be base64-encoded and it must be one of the
     *      following bit lengths before being base64-encoded: 128, 192, or 256.
     *      The key must also be encrypted by using the Amazon Key Management Service
     *
     * @param string $keyMd5 - The MD5 digest of the key that you used to encrypt your input file, or that you want
     *      Elastic Transcoder to use to encrypt your output file. Elastic Transcoder uses the key
     *      digest as a checksum to make sure your key was not corrupted in transit. The key MD5 must
     *      be base64-encoded, and it must be exactly 16 bytes long before being base64-encoded.
     *
     * @return \Programster\AwsWrapper\ElasticTranscoder\EncryptionMode
     */
    public static function createAesCbcPkcs7(string $initializationVector, string $key, string $keyMd5) : EncryptionMode
    {
        return new EncryptionMode("aes-cbc-pkcs7", $initializationVector, $key, $keyMd5);
    }


    /**
     * AES Counter Mode.
     *
     * @param string $initializationVector - The series of random bits created by a random bit generator, unique for
     *      every encryption operation, that you used to encrypt your input files or that you want Elastic Transcoder
     *      to use to encrypt your output files. The initialization vector must be base64-encoded, and it must be
     *      exactly 16 bytes long before being base64-encoded.
     *
     * @param string $key - The data encryption key that you want Elastic Transcoder to use to encrypt your output
     *      file, or that was used to encrypt your input file. The key must be base64-encoded and it must be one of the
     *      following bit lengths before being base64-encoded: 128, 192, or 256.
     *      The key must also be encrypted by using the Amazon Key Management Service
     *
     * @param string $keyMd5 - The MD5 digest of the key that you used to encrypt your input file, or that you want
     *      Elastic Transcoder to use to encrypt your output file. Elastic Transcoder uses the key
     *      digest as a checksum to make sure your key was not corrupted in transit. The key MD5 must
     *      be base64-encoded, and it must be exactly 16 bytes long before being base64-encoded.
     *
     * @return \Programster\AwsWrapper\ElasticTranscoder\EncryptionMode
     */
    public static function createAesCtr(string $initializationVector, string $key, string $keyMd5) : EncryptionMode
    {
        return new EncryptionMode("aes-ctr", $initializationVector, $key, $keyMd5);
    }


    /**
     * AES Galois Counter Mode, a mode of operation that is an authenticated encryption format, meaning that a file,
     * key, or initialization vector that has been tampered with fails the decryption process.
     *
     * @param string $initializationVector - The series of random bits created by a random bit generator, unique for
     *      every encryption operation, that you used to encrypt your input files or that you want Elastic Transcoder
     *      to use to encrypt your output files. The initialization vector must be base64-encoded, and it must be
     *      exactly 16 bytes long before being base64-encoded.
     *
     * @param string $key - The data encryption key that you want Elastic Transcoder to use to encrypt your output
     *      file, or that was used to encrypt your input file. The key must be base64-encoded and it must be one of the
     *      following bit lengths before being base64-encoded: 128, 192, or 256.
     *      The key must also be encrypted by using the Amazon Key Management Service
     *
     * @param string $keyMd5 - The MD5 digest of the key that you used to encrypt your input file, or that you want
     *      Elastic Transcoder to use to encrypt your output file. Elastic Transcoder uses the key
     *      digest as a checksum to make sure your key was not corrupted in transit. The key MD5 must
     *      be base64-encoded, and it must be exactly 16 bytes long before being base64-encoded.
     *
     * @return \Programster\AwsWrapper\ElasticTranscoder\EncryptionMode
     */
    public static function createAesGcm(string $initializationVector, string $key, string $keyMd5) : EncryptionMode
    {
        return new EncryptionMode("aes-gcm", $initializationVector, $key, $keyMd5);
    }


    public function toArray()
    {
        $arrayForm = array(
            'Mode' => $this->m_mode
        );

        if ($this->m_key !== null)
        {
            $arrayForm['Key'] = $this->m_key;
        }

        if ($this->m_keyMd5 !== null)
        {
            $arrayForm['KeyMd5'] = $this->m_keyMd5;
        }

        if ($this->m_initializationVector !== null)
        {
            $arrayForm['InitializationVector'] = $this->m_initializationVector;
        }

        return $arrayForm;
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }
}

