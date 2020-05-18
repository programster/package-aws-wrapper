<?php

namespace Programster\AwsWrapper\Chime;

use \Programster\AwsWrapper\Objects\Tag;
use \Programster\AwsWrapper\Enums\AwsRegion;


class ChimeClient
{
    private $m_client;

    
    public function __construct(string $apiKey, string $apiSecret, AwsRegion $region)
    {
        $credentials = array(
            'key'    => $apiKey,
            'secret' => $apiSecret
        );

        $params = array(
            'credentials' => $credentials,
            'version'     => '2018-05-01',
            'region'      => (string)$region,
        );

        $this->m_client = new \Aws\Chime\ChimeClient($params);
    }
    
    
    /**
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-chime-2018-05-01.html#createattendee
     */
    public function createAttendee(string $externalUserId, string $meetingId, Tag ...$tags)
    {
        $params = array(
            'ExternalUserId' => $externalUserId, // REQUIRED
            'MeetingId' => $meetingId, // REQUIRED
        );
        
        if (count($tags) > 0)
        {
            $params['Tags'] = $tags;
        }
        
        $response = $this->m_client->createAttendee($params);
    }
    
    
    public function getAttendee(string $attendeeId, string $meetingId)
    {
        $params = [
            'AttendeeId' => $attendeeId,
            'MeetingId' => $meetingId,
        ];
        
        $response = $this->m_client->getAttendee($params);
    }
    

    /**
     * Creates a new Amazon Chime SDK meeting in the specified media Region with no initial attendees. 
     * For more information about the Amazon Chime SDK, see Using the Amazon Chime SDK in the Amazon Chime Developer Guide.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-chime-2018-05-01.html#createmeeting
     * @param string|null $clientRequestToken - optionally provide a client request token. If you do not provide one
     *                                          we will generate one for you based on a UUID type 4.
     * @param string|null $externalMeetingId
     * @param AwsRegion|null $mediaRegion
     * @param string|null $meetingHostId
     * @param \Programster\AwsWrapper\Chime\NotificationsConfiguration|null $notificationsConfiguration
     * @param Tag $tags
     */
    public function createMeeting(
        ?string $clientRequestToken = null, 
        ?string $externalMeetingId = null, 
        ?AwsRegion $mediaRegion = null, 
        ?string $meetingHostId = null, 
        ?NotificationsConfiguration $notificationsConfiguration = null, 
        Tag ...$tags
    )
    {
        if ($clientRequestToken === null)
        {
            $clientRequestToken = \Ramsey\Uuid\Uuid::uuid4();
        }
        
        $params = array(
            'ClientRequestToken' => $clientRequestToken,
        );
        
        if ($externalMeetingId !== null)
        {
            $params['ExternalMeetingId'] = $externalMeetingId;
        }
        
        if ($mediaRegion !== null)
        {
            $params['MediaRegion'] = (string)$mediaRegion;
        }
        
        if (count($tags) > 0)
        {
            $params['Tags'] = $tags;
        }
        
        if ($meetingHostId !== null)
        {
            $params['MeetingHostId'] = $meetingHostId;
        }
         
        if ($notificationsConfiguration !== null)
        {
            $params['NotificationsConfiguration'] = $notificationsConfiguration;
        }
        
        $response = $this->m_client->createMeeting($params);
        
        return $response;
    }
    
    
    /**
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-chime-2018-05-01.html#listattendees
     */
    public function listAttendees($meetingID, ?int $maxREsults=null)
    {
        
    }
    
    
    # https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-chime-2018-05-01.html#listmeetings
    public function listMeetings(?int $maxResults = null)
    {
        $parameters = array();
        
        if ($maxRexults !== null)
        {
            $parameters['MaxResults'] = $maxRexults;
        }
        
        $response = $this->m_client->listMeetings($parameters);
        
        # process response here.
    }
    
    
    /**
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-chime-2018-05-01.html#getmeeting
     */ 
    public function getMeeting()
    {
        
    }
    
    
    /**
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-chime-2018-05-01.html#deletemeeting
     */
    public function deleteMeeting(string $meetingId)
    {
        $params = ['MeetingId' => $meetingId];
        $response = $this->m_client->deleteMeeting($params);
        
        // parse the response here...
    }
}