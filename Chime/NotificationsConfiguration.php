<?php

/* 
 * An object to provide a NotificationsConfiguration.
 */

namespace Programster\AwsWrapper\Chime;


class NotificationsConfiguration implements JsonSerializable
{
    private $m_sqsArn;
    private $m_snsArn;
    
            
    public static function createFromSns(string $snsArn)
    {
        $this->m_snsArn = $snsArn;
    }
    
    
    public static function createFromSqs(string $sqsArn)
    {
        $this->m_sqsArn = $sqsArn;
    }
    
    
    public function toArray() : array
    {
        $arrayForm = array();
        
        if ($this->m_snsArn !== null)
        {
            $arrayForm = array(
                'SnsTopicArn' => $this->m_snsArn,
            );
        }
        else
        {
            $arrayForm = array(
                'SqsQueueArn' => $this->m_sqsArn,
            );
        }
        
        return $arrayForm;
    }

    
    public function jsonSerialize() 
    {
        return $this->toArray();
    }
}
