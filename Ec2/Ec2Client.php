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
     * @param \Programster\AwsWrapper\Requests\RequestRunInstances $request
     * @return type
     */
    public function runInstances(\Programster\AwsWrapper\Requests\RequestRunInstances $request)
    {
        return $request->send($this->m_client);
    }


    /**
     * Alias for RunInstances
     * @param \Programster\AwsWrapper\Requests\RequestRunInstances $request
     */
    public function requestOnDemandInstances(\Programster\AwsWrapper\Requests\RequestRunInstances $request)
    {
        $this->runInstances($request);
    }


    /**
     * Sent a request to start some stopped instances. This does NOT "create" instances, use "runInstances()" for that.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-ec2-2016-11-15.html#startinstances
     */
    public function startInstances(\Programster\AwsWrapper\Requests\RequestStartInstances $request)
    {
        return $request->send($this->m_client);
    }


    /**
     * Sent a request to stop some stopped instances. This does NOT "terminate" instances.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-ec2-2016-11-15.html#stopinstances
     */
    public function stopInstances(\Programster\AwsWrapper\Requests\RequestStopInstances $request)
    {
        return $request->send($this->m_client);
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
