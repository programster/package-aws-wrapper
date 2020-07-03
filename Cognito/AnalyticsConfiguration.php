<?php

namespace Programster\AwsWrapper\Cognito;

class AnalyticsConfiguration implements JsonSerializable
{
    private $m_applicationId;
    private $m_externalId;
    private $m_roleArn;
    private $m_usersDataShared;


    /**
     * The Amazon Pinpoint analytics configuration for collecting metrics for a user pool.
     * Cognito User Pools only supports sending events to Amazon Pinpoint projects in the US East (N. Virginia)
     * us-east-1 Region, regardless of the region in which the user pool resides.
     *
     * @param string $applicationId - The application ID for an Amazon Pinpoint application.
     * @param string $externalId
     * @param string $roleArn - The ARN of an IAM role that authorizes Amazon Cognito to publish events to Amazon
     *                          Pinpoint analytics.
     * @param bool $userDataShared - If UserDataShared is true, Amazon Cognito will include user data in the events it
     *                               publishes to Amazon Pinpoint analytics.
     */
    public function __construct(string $applicationId, string $externalId, string $roleArn, bool $userDataShared)
    {
        $this->m_applicationId = $applicationId;
        $this->m_externalId = $externalId;
        $this->m_roleArn = $roleArn;
        $this->m_usersDataShared = $userDataShared;
    }


    public function toArray() : array
    {
        return [
            'ApplicationId' => $this->m_applicationId,
            'ExternalId' => $this->m_externalId,
            'RoleArn' => $this->m_roleArn,
            'UserDataShared' => $this->m_usersDataShared,
        ];
    }


    public function jsonSerialize()
    {
        return $this->toArray()
    }

}

