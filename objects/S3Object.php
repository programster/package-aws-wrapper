<?php

/*
 *
 */

namespace Programster\AwsWrapper\Objects;

class S3Object
{
    private $m_key;
    private $m_lastModified;
    private $m_size;
    private $m_storageClass;
    private $m_owner;
    private $m_eTag;


    public function __construct($data)
    {
        $this->m_key = $data['Key'];
        $this->m_lastModified = $data['LastModified'];
        $this->m_size = $data['Size'];
        $this->m_storageClass = $data['StorageClass'];
        $this->m_owner = (isset($data['Owner'])) ? new S3ObjectOwner($data['Owner']) : null;
        $this->m_eTag = (isset($data['ETag'])) ? $data['ETag'] : null;
    }


    # accessors
    public function getKey() : string { return $this->m_key; }
    public function getLastModified() : DateTimeResult { return $this->m_lastModified; }
    public function getSize() : int { return $this->m_size; }
    public function getStorageClass() : string { return $this->m_storageClass; }
    public function getOwner() : ?S3ObjectOwner { return $this->m_owner; }
    public function getEtag() : ?string { return $this->m_eTag; }
}

/*
 * ["Key"]=>
        string(8) "folder1/"
        ["LastModified"]=>
        object(Aws\Api\DateTimeResult)#122 (3) {
          ["date"]=>
          string(26) "2018-12-06 09:24:55.000000"
          ["timezone_type"]=>
          int(2)
          ["timezone"]=>
          string(1) "Z"
        }
        ["ETag"]=>
        string(34) ""d41d8cd98f00b204e9800998ecf8427e""
        ["Size"]=>
        int(0)
        ["StorageClass"]=>
        string(8) "STANDARD"
        ["Owner"]=>
        array(2) {
          ["DisplayName"]=>
          string(7) "support"
          ["ID"]=>
          string(64) "7b3452424b0c2fac4c2a2f503975c4417d9dea29d6af37e1f96290b01a280ab5"
        }

 */