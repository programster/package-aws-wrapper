<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Programster\AwsWrapper\Workspaces;


class VolumeEncryptionConfig implements JsonSerializable
{
    private $m_encryptionKey;
    private $m_encryptRootVolume;
    private $m_encryptUserVolume;


    private function __construct(bool $encryptRootVolume, bool $encryptUserVolume, ?string $encryptionKey)
    {
        $this->m_encryptRootVolume = $encryptRootVolume;
        $this->m_encryptUserVolume = $encryptUserVolume;
        $this->m_encryptionKey = $encryptionKey;
    }


    /**
     * Use this if you don't wish to have either  the root or user volumes encrypted.
     */
    public static function createEncryptionDisabled() : VolumeEncryptionConfig
    {
        return new VolumeEncryptionConfig(false, false, null);
    }


    /**
     * Create a configuration where the root and/or the user volumes are encrypted.
     * @param string $volumeEncryptionKey - The symmetric AWS KMS customer master key (CMK) used to encrypt data
     *                                      stored on your WorkSpace. Amazon WorkSpaces does not support asymmetric CMKs.
     * @param bool $encryptRootVolume - optionally set to false to not encrypt the root volume (defaults true)
     * @param bool $encryptUserVolume - optionally set to false to not encrypt the user volume (defaults true).
     * @return \Programster\AwsWrapper\Workspaces\VolumeEncryptionConfig
     */
    public static function createEncryptionEnabled(
        string $volumeEncryptionKey,
        bool $encryptRootVolume=true,
        bool $encryptUserVolume=true
    ) : VolumeEncryptionConfig
    {
        return new VolumeEncryptionConfig($encryptRootVolume, $encryptUserVolume, $volumeEncryptionKey);
    }


    public function toArray()
    {
        $arrayForm = [
            'RootVolumeEncryptionEnabled' => $this->m_encryptRootVolume,
            'UserVolumeEncryptionEnabled' => $this->m_encryptUserVolume,
        ];

        if ($this->m_encryptionKey !== null)
        {
            $arrayForm['VolumeEncryptionKey'] = $this->m_encryptionKey;
        }

        return $arrayForm;
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
