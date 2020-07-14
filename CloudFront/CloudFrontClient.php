<?php

/*
 * Client for interfacing with Amazon CloudFRont
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.CloudFront.CloudFrontClient.html
 */

namespace Programster\AwsWrapper\CloudFront;

class CloudFrontClient
{
    private $m_client;


    public function __construct(string $apiKey, string $apiSecret, \Programster\AwsWrapper\Enums\AwsRegion $region)
    {
        $credentials = array(
            'key'    => $apiKey,
            'secret' => $apiSecret,
        );

        $params = array(
            "credentials" => $credentials,
            "profile"     => "default",
            "version"     => "2014-11-06",
            "region"      => (string) $region,
        );

        $this->m_client = new \Aws\CloudFront\CloudFrontClient($params);
    }


    /**
     * Creates and sets a cookie in the user's browser that will give them access to the secure content in the CDN.
     * @param string $resourceKey - the key to the resource(s) we wish to grant access to. E.g.
     *                              'https://example-distribution.cloudfront.net/videos/myHlsVideoFolder/*'
     * @param int $duration - how long the cookie should grant access to the resources for in seconds.
     * @param string $privateKeyPath - the path to the private key used for signing the request.
     * @param string $cdnKeyId - the ID of the key in AWS that the private key is from.
     * @param string $cdnDistroDamainName -  the domain of the CDN. e.g. blah.cloudfront.net
     */
    public function getSignedCookie(
        string $resourceKey,
        int $duration,
        string $privateKeyPath,
        string $cdnKeyId
    )
    {
        // Create the policy that restricts access to the client's IP address and adds an expiry time.
        $expires = time() + $duration;
        $conditions = ["DateLessThan" => ["AWS:EpochTime" => $expires]];

        // Limit by the client's IP address (except if local devving on private IP).
        if (\Programster\CoreLibs\Core::isPrivateIp($_SERVER['REMOTE_ADDR']) === false)
        {
            $conditions["IpAddress"] = ["AWS:SourceIp" => "{$_SERVER['REMOTE_ADDR']}/32"];
        }

        $statement = [
            "Resource" => $resourceKey,
            "Condition" => $conditions
        ];

        $statements = array($statement);
        $customPolicyArray = ["Statement" => $statements];
        $customPolicyJsonString = json_encode($customPolicyArray, JSON_UNESCAPED_SLASHES);

        $settings = array(
            'policy' => $customPolicyJsonString,
            'private_key' => $privateKeyPath,
            'key_pair_id' => $cdnKeyId
        );

        return $this->m_client->getSignedCookie($settings);
    }
}