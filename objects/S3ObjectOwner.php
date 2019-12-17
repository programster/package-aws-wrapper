<?php

/*
 *
 */

namespace Programster\AwsWrapper\Objects;

class S3ObjectOwner
{
    private $m_id;
    private $m_displayName;


    public function __construct($data)
    {
        $this->m_id = $data['ID'];

        if (isset($data['DisplayName']))
        {
            $this->m_displayName = $data['DisplayName'];
        }
        else
        {
            $this->m_displayName = "";
        }
    }


    # Accessors
    public function getId() : string { return $this->m_id; }
    public function getDisplayname() : string { return $this->m_displayName; }
}
