<?php

/*
 * The allowed OAuth scopes. Possible values provided by OAuth are: phone, email, openid, and profile.
 * Possible values provided by AWS are: aws.cognito.signin.user.admin. Custom scopes created in Resource Servers are also supported.
 */

class AuthScope implements JsonSerializable
{
    private $m_scope;


    private function __construct(string $scope)
    {
        $this->m_scope = $scope;
    }


    public static function createPhone() : AuthScope
    {
        return new AuthScope("phone");
    }


    public static function createEmail() : AuthScope
    {
        return new AuthScope("email");
    }


    public static function createOpenId() : AuthScope
    {
        return new AuthScope("openid");
    }


    public static function createProfile() : AuthScope
    {
        return new AuthScope("profile");
    }


    /**
     * Create a custom scope for resource servers.
     * @param string $scope
     */
    public static function createCustom(string $scope) : AuthScope
    {
        return new AuthScope($scope);
    }


    public function __toString()
    {
        return $this->m_scope;
    }


    public function jsonSerialize()
    {
        return $this->m_scope;
    }
}

