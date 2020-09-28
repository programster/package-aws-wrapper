<?php

declare(strict_types = 1);

namespace Programster\AwsWrapper\Requests;

/*
 * A request to terminate a single or multiple instances.
 */

class RequestStartInstances extends Ec2RequestAbstract
{
    private $m_instanceIds = array();


    /**
     * Create a request to terminate one or more ec2 instances.
     * @param AmazonRegion $region - the region the instances are located in.
     * @param mixed $instance_ids - a single instance id or an array of instance ids
     */
    public function __construct(string ...$instance_ids)
    {
        if (count($instance_ids) === 0)
        {
            $errMsg = get_called_class() . ': need to provide at least one string ID of an instance to start.';
            throw new \Exception($errMsg);
        }

        $this->m_instanceIds = $instance_ids;
    }


    protected function getOptionsArray()
    {
        return array(
            'InstanceIds' => $this->m_instanceIds
        );
    }


    protected function sendRequest(\Aws\Ec2\Ec2Client $ec2, array $opt)
    {
        $response = $ec2->startInstances($opt);
        return $response;
    }
}
