<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.CognitoIdentity.CognitoIdentityClient.html
 */

namespace Programster\AwsWrapper\Cognito;


class CognitoIdentityClient
{
    private $m_client;


    public function __construct()
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
}



