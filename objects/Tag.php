<?php

/* 
 * Create a tag object for requests.
 */

namespace Programster\AwsWrapper\Objects;

class Tag implements \JsonSerializable
{
    private $m_name;
    private $m_value;
    
    
    public function __construct(string $name, string $value) 
    {
        $this->m_name = $name;
        $this->m_value = $value;
    }
    
    
    /**
     * Convert this object into a format that AWS expects in requests.
     * @return array
     */
    public function toArray() : array
    {
        return [
            'Key' => $this->m_key,
            'Value' => $this->m_value,
        ];
    }

    
    public function jsonSerialize() 
    {
        return $this->toArray();
    }
}
