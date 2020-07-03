<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.CognitoIdentityProvider.CognitoIdentityProviderClient.html
 */

namespace Programster\AwsWrapper\Cognito;


class CognitoIdentityProviderClient
{
    private $m_client;


    public function __construct($apiKey, $apiSecret, \Programster\AwsWrapper\Enums\AwsRegion $region)
    {
        $credentials = array(
            'key'    => $apiKey,
            'secret' => $apiSecret
        );

        $params = array(
            'credentials' => $credentials,
            'version'     => '2006-03-01',
            'region'      => (string) $region,
        );

        $this->m_client = new \Aws\CognitoIdentityProvider\CognitoIdentityProviderClient($params);
    }



    /**
     * Creates a new user in the specified user pool.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-cognito-idp-2016-04-18.html#admincreateuser
     *
     * If MessageAction is not set, the default is to send a welcome message via email or phone (SMS).
     * This message is based on a template that you configured in your call to or . This template includes your custom sign-up instructions and placeholders for user name and temporary password.
     * Alternatively, you can call AdminCreateUser with “SUPPRESS” for the MessageAction parameter, and Amazon Cognito will not send any email.
     * In either case, the user will be in the FORCE_CHANGE_PASSWORD state until they sign in and change their password.
     */

    /**
     *
     * @param string $userPoolId
     * @param string $username
     *
     * @param bool $forceAliasCreation - This parameter is only used if the phone_number_verified or email_verified
     * attribute is set to True. Otherwise, it is ignored.
     *
     * @param bool $resendInviteIfAlreadyExists - if true then an invite will get re-sent if user already exists, if not
     * then the invite is suppressed.
     *
     * @param string|null $temporaryPassword - The user's temporary password. This password must conform to the
     * password policy that you specified when you created the user pool. If you do not specify a value (null),
     * Amazon Cognito generates one for you.
     */
    public function adminCreateUser(
        string $userPoolId,
        string $username,
        bool $forceAliasCreation,
        bool $resendInviteIfAlreadyExists,
        ?string $temporaryPassword,
        \Programster\AwsWrapper\Objects\Tag ...$userAttributes
    )
    {
        $params = [
            'UserPoolId' => $userPoolId,
            'Username' => $username,

            'MessageAction' => ($resendInviteIfAlreadyExists) ? 'RESEND' : 'SUPPRESS',
            'TemporaryPassword' => '<string>',

            'ClientMetadata' => ['<string>', ...],
            'DesiredDeliveryMediums' => ['<string>', ...],

'ForceAliasCreation' => $forceAliasCreation,

            'UserAttributes' => [
                [
                    'Name' => '<string>', // REQUIRED
                    'Value' => '<string>',
                ],
                // ...
            ],
        ];
    }


    /**
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-cognito-idp-2016-04-18.html#createuserpoolclient
     */
    public function createUserPoolClient(
        string $clientName,
        string $userPoolId,
        ?\AnalyticsConfiguration $analyticsConfig,
        AuthFlow ... $allowedOAuthFlows
    )
    {
        throw new Exception("Not yet implemented");
    }
}