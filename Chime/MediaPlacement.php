<?php


namespace Programster\AwsWrapper\Chime;


class MediaPlacement implements \JsonSerializable
{
    private $m_arrayForm;
    private $m_audioHostUrl;
    private $m_audioFallbackUrl;
    private $m_screenDataUrl;
    private $m_screenSharingUrl;
    private $m_screenViewingUrl;
    private $m_signalingUrl;
    private $m_turnControlUrl;
    
    
    private function __construct() 
    {
        
    }
    
    
    public static function createFromArray(array $arrayForm)
    {
        $mediaPlacement = new MediaPlacement();
        $mediaPlacement->m_arrayForm = $arrayForm;
        $mediaPlacement->m_audioHostUrl = $arrayForm['AudioHostUrl'];
        $mediaPlacement->m_audioFallbackUrl = $arrayForm['AudioFallbackUrl'];
        $mediaPlacement->m_screenDataUrl = $arrayForm['ScreenDataUrl'];
        $mediaPlacement->m_screenSharingUrl = $arrayForm['ScreenSharingUrl'];
        $mediaPlacement->m_screenViewingUrl = $arrayForm['ScreenViewingUrl'];
        $mediaPlacement->m_signalingUrl = $arrayForm['SignalingUrl'];
        $mediaPlacement->m_turnControlUrl = $arrayForm['TurnControlUrl'];
    }
    
    
    public function jsonSerialize() 
    {
        return $this->m_arrayForm;
    }
    
    
    # Accessors
    public function getAudioHostUrl() : string { return $this->m_audioHostUrl; }
    public function getAudioFallbackUrl() : string { return $this->m_audioFallbackUrl; }
    public function getScreenDataUrl() : string { return $this->m_screenDataUrl; }
    public function getScreenSharingUrl() : string { return $this->m_screenSharingUrl; }
    public function getScreenViewingUrl() : string { return $this->m_screenViewingUrl; }
    public function getSignalingUrl() : string { return $this->m_signalingUrl; }
    public function getTurnControlUrl() : string { return $this->m_turnControlUrl; }
}