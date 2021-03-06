<?php

namespace Programster\AwsWrapper\Chime;



class ResponseCreateMeeting
{
    private $m_meeting;
    private $m_responseCode;
    private $m_rawResponse;
    
    
    public function __construct(\Aws\Result $response)
    {
        $this->m_rawResponse = $response;
        $arrayForm = $response->toArray();
        $metadata = $arrayForm['@metadata'];
        $this->m_responseCode = $metadata['statusCode'];
        
        if ($metadata['statusCode'] === 201)
        {
            // successfully created meeting
            $this->m_meeting = ChimeMeeting::createFromArray($arrayForm['Meeting']);
        }
        else
        {
            // handle here.
        }
    }
    
    
    /**
     * Find out if the response is okay. E.g. no errors.
     * @return bool
     */
    public function isOk() : bool
    {
        return $this->m_responseCode === 201;
    }
    
    
    /**
     * Returns the meeting that was returned in the response object.
     * @return \Programster\AwsWrapper\Chime\ChimeMeeting
     * @throws \Exception - if there is no meeting
     */
    public function getMeeting() : ChimeMeeting 
    { 
        if ($this->m_meeting === null)
        {
            throw new \Exception("Create meeting response was unsuccessful. There is no meeting.");
        }
        
        return $this->m_meeting; 
    }
    
    
    /**
     * Get the underlying aws response that this object was created from.
     * You may want this for debugging errors.
     * @return \Aws\Result
     */
    public function getRawResponse() : \Aws\Result { return $this->m_rawResponse; }
}