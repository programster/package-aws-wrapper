<?php

/*
 * An enum to represent the various OAuth Flows that can be chosen.
 */

namespace Programster\AwsWrapper\Cognito;

class AuthFlow implements \JsonSerializable
{
    private $m_flowString;


    private function __construct(string $flowString)
    {
        $this->m_flowString = $flowString;
    }


    /**
     * A code grant flow, which provides an authorization code as the response. This code can be exchanged for access
     * tokens with the token endpoint.
     * @return \AuthFlow
     */
    public static function createCode() : AuthFlow
    {
        return new AuthFlow('code');
    }


    /**
     * Client should get the access token (and, optionally, ID token, based on scopes) directly.
     * @return \AuthFlow
     */
    public static function createImplicit() : AuthFlow
    {
        return new AuthFlow('implicit');
    }


    /**
     * The client should get the access token (and, optionally, ID token, based on scopes) from the token endpoint
     * using a combination of client and client_secret.
     * @return \AuthFlow
     */
    public static function createClientCredentials() : AuthFlow
    {
        return new AuthFlow('client_credentials');
    }


    public function __toString()
    {
        return $this->m_flowString;
    }

    
    public function jsonSerialize()
    {
        return $this->m_flowString;
    }
}
