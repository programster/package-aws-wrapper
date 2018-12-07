<?php

namespace Programster\AwsWrapper\Responses;

/*
 * A response for a request to list objects.
 */

class ResponseListObjects
{
    private $m_objects = [];
    private $m_isTruncated;
    
    public function __construct(\Aws\Result $result)
    {
        $this->m_isTruncated = $result->get('IsTruncated');
        $contents = $result->get('Contents');
        
        if ($contents !== null && count($contents) > 0) {
            foreach ($contents as $content) {
                $this->m_objects[] = new \Programster\AwsWrapper\Objects\S3Object($content);
            }
        }
    }
    
    
    # Accessors
    public function getObjects() : array { return $this->m_objects; }
    public function isTruncated() : bool { return $this->m_isTruncated; }
}

