<?php

/*
 * Client for interfacing with AWS Ec2
 * You may find this useful:
 * http://docs.aws.amazon.com/aws-sdk-php/v3/api/api-ec2-2015-04-15.html
 */

namespace Programster\AwsWrapper\Ec2;

class Ec2Client
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
            'version'     => '2015-04-15',
            'region'      => (string) $region,
        );
        
        $this->m_client = new \Aws\Ec2\Ec2Client($params);
    }
    
    
    /**
     *
     * http://docs.aws.amazon.com/aws-sdk-php/v3/api/api-ec2-2015-04-15.html#describeinstances
     */
    public function describeInstances(\Programster\AwsWrapper\Requests\RequestDescribeInstances $request)
    {
        return $request->send($this->m_client);
    }
    
    
    /**
     * Launch some on demand instances (fixed price).
     * http://docs.aws.amazon.com/aws-sdk-php/v3/api/api-ec2-2015-04-15.html#runinstances
     */
    public function runInstances(\Programster\AwsWrapper\Requests\RequestRunInstances $request)
    {
        return $request->send($this->m_client);
    }
    
    
    /**
     * Alias for RunInstances
     */
    public function requestOnDemandInstances()
    {
        $this->runInstances();
    }
    
    
    /**
     * Send a request to terminate instances.
     * http://docs.aws.amazon.com/aws-sdk-php/v3/api/api-ec2-2015-04-15.html#terminateinstances
     * @param \Programster\AwsWrapper\Requests\RequestTerminateInstance $request
     * @return \Aws\Result
     */
    public function terminateInstances(\Programster\AwsWrapper\Requests\RequestTerminateInstance $request)
    {
        return $request->send($this->m_client);
    }
}