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
     * Create an attendee
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-chime-2018-05-01.html#createattendee
     * 
     * @param string $meetingId - the ID of the meeting the attendee will be attending.
     * @param string $externalUserId - optionally provide an ID of your user. It not provided, a UUID for the attendee
     *                                 will be generated for you.
     * @param Tag $tags
     * @return \Programster\AwsWrapper\Chime\ResponseCreateAttendee
     */
    public function createAttendee(string $meetingId, string $externalUserId = null, Tag ...$tags) : ResponseCreateAttendee
    {
        if ($externalUserId === null)
        {
            $externalUserId = \Ramsey\Uuid\Uuid::uuid4();
        }
        
        $params = array(
            'ExternalUserId' => $externalUserId, // REQUIRED
            'MeetingId' => $meetingId, // REQUIRED
        );
        
        if (count($tags) > 0)
        {
            $params['Tags'] = $tags;
        }
        
        $awsResponse = $this->m_client->createAttendee($params);
        $response = new ResponseCreateAttendee($awsResponse);
        return $response;
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
    ) : ResponseCreateMeeting
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
        
        $awsResponse = $this->m_client->createMeeting($params);
        return new ResponseCreateMeeting($awsResponse);
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