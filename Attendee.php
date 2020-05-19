<?php

namespace Programster\AwsWrapper\Chime;


class Attendee
{
    private $m_externalUserId;
    private $m_attendeeId;
    private $m_joinToken;
    
    
    private function __construct()
    {
        
    }
    
    
    public static function createFromArray(array $arrayForm) : ChimeMeeting
    {
        $attendee = new Attendee();
        $attendee->m_externalUserId = $arrayForm['ExternalUserId'];
        $attendee->m_attendeeId = MediaPlacement::createFromArray($arrayForm['AttendeeId']);
        $attendee->m_joinToken = \Programster\AwsWrapper\Enums\AwsRegion::create_from_string($arrayForm['JoinToken']);
        return $attendee;
    }
    
    
    # Accessors
    public function getExternalUserId() : string { return $this->m_externalUserId; }
    public function getAttendeeId() : string { return $this->m_attendeeId; }
    public function getJoinToken() : string { return $this->m_joinToken; }
    
}

