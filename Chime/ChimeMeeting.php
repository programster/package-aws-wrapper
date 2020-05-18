<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Programster\AwsWrapper\Chime;


class ChimeMeeting implements \JsonSerializable
{
    private $m_arrayForm;
    private $m_meetingId;
    private $m_mediaPlacement;
    private $m_mediaRegion;
    
    
    private function __construct()
    {
        
    }
    
    
    public static function createFromArray(array $arrayForm) : ChimeMeeting
    {
        $meeting = new ChimeMeeting();
        $meeting->m_meetingId = $arrayForm['MeetingId'];
        $meeting->m_mediaPlacement = MediaPlacement::createFromArray($arrayForm['MediaPlacement']);
        $meeting->m_mediaRegion = \Programster\AwsWrapper\Enums\AwsRegion::create_from_string($arrayForm['MediaRegion']);
        return $meeting;
    }
    
    
    public function jsonSerialize() 
    {
        return $this->m_arrayForm;
    }
    
    
    # Accessors
    public function getMeetingId() : string { return $this->m_meetingId; }
    public function getMediaPlacement() : MediaPlacement { return $this->m_mediaPlacement; }
    public function getMediaRegion() : \Programster\AwsWrapper\Enums\AwsRegion { return $this->m_mediaRegion; }
}
