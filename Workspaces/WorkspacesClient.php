<?php

/*
 * A client to make it easy to create/manage AWS workspaces.
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-workspaces-2015-04-08.html
 */

namespace Programster\AwsWrapper\Workspaces;

use \Programster\AwsWrapper\Objects\Tag;
use \Programster\AwsWrapper\Enums\AwsRegion;


class WorkspacesClient
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
            'version'     => '2015-04-08',
            'region'      => (string)$region,
        );

        $this->m_client = new \Aws\WorkSpaces\WorkSpacesClient($params);
    }


    /**
     * Create workspaces
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-workspaces-2015-04-08.html#createworkspaces
     */
    public function createWorkspaces(WorkspaceConfig ...$workspaceConfigs)
    {
        if (count($workspaceConfigs) === 0)
        {
            throw new \Exception("You must provide at lease one workspace config to create workspaces");
        }
        
        $params = array(
            'Workspaces' => $workspaceConfigs
        );

        $response = $this->m_client->createWorkspaces($params);
        return $response;
    }
}