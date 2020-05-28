<?php

/*
 * A configuration for a workspace.
 */

namespace Programster\AwsWrapper\Workspaces;

class WorkspacePropertyConfig implements \JsonSerializable
{
    private $m_computeTypeName;
    private $m_rootVolumeSize;
    private $m_runningMode;
    private $m_runningModeAutoStopTimeoutInMinutes;
    private $m_userVolumeSizeGib;


    /**
     *
     * @param \Programster\AwsWrapper\Workspaces\ComputeTypeName $type - the type of workspace to deploy.
     *                                                                   E.g. do you need a cheap one or a powerful one?
     * @param int $rootVolumeSizeGib - how large the root volume should be in GiB
     * @param int $userVolumeSizeGib - how large the user volume should be in GiB
     * @param \Programster\AwsWrapper\Workspaces\RunningMode $runningMode
     */
    public function __construct(
        ComputeTypeName $type,
        int $rootVolumeSizeGib,
        int $userVolumeSizeGib,
        RunningMode $runningMode
    )
    {
        $this->m_type = $type;
        $this->m_rootVolumeSize = $rootVolumeSizeGib;
        $this->m_userVolumeSizeGib = $userVolumeSizeGib;
        $this->m_runningMode = $runningMode;
    }


    public function toArray() : array
    {
        $arrayForm = [
            'ComputeTypeName' => (string)$this->m_computeTypeName,
            'RootVolumeSizeGib' => $this->m_rootVolumeSize,
            'UserVolumeSizeGib' => $this->m_userVolumeSizeGib,
        ];

        $arrayForm = array_merge($arrayFor, $this->m_runningMode->toArray());
        return $arrayForm;
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
