<?php

namespace Programster\AwsWrapper\Chime;


class Attendee implements \JsonSerializable
{
    private $m_externalUserId;
    private $m_attendeeId;
    private $m_joinToken;
    private $m_arrayForm;
    
    
    private function __construct()
    {
        
    }
    
    
    public static function createFromArray(array $arrayForm) : Attendee
    {
        $attendee = new Attendee();
        $attendee->m_arrayForm = $arrayForm;
        $attendee->m_externalUserId = $arrayForm['ExternalUserId'];
        $attendee->m_attendeeId = $arrayForm['AttendeeId'];
        $attendee->m_joinToken = $arrayForm['JoinToken'];
        return $attendee;
    }
    
    
    public function jsonSerialize() 
    {
        return $this->m_arrayForm;
    }
    
    
    # Accessors
    public function getExternalUserId() : string { return $this->m_externalUserId; }
    public function getAttendeeId() : string { return $this->m_attendeeId; }
    public function getJoinToken() : string { return $this->m_joinToken; }
}

