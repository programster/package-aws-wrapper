<?php

/*
 * An object to represent a workspace config
 */

namespace Programster\AwsWrapper\Workspaces;

use \Programster\AwsWrapper\Objects\Tag;


class WorkspaceConfig implements JsonSerializable
{
    private $m_username;
    private $m_bundleId;
    private $m_directoryId;
    private $m_workspacePropertyConfig;
    private $m_volumeEncryptionConfig;
    private $m_tags;


    /**
     * Create a workspace configuration which can be used for creating one or more workspaces.
     * @param string $bundleId - The identifier of the bundle. A WorkSpace bundle is a combination of an
     *                           operating system, and storage, compute, and software resources. When you launch a
     *                           WorkSpace, you select the bundle that meets your needs. The default bundles available
     *                           for WorkSpaces are called public bundles.
     *
     * @param string $directoryId - The identifier of the AWS Directory Service directory for the WorkSpace.
     *
     * @param \Programster\AwsWrapper\Workspaces\VolumeEncryptionConfig $volumeEncryptionConfig
     *
     * @param string $username - The user name of the user for the WorkSpace. This user name must exist in the
     *                           AWS Directory Service directory for the WorkSpace.
     *
     * @param \Programster\AwsWrapper\Workspaces\WorkspacePropertyConfig $workspacePropertyConfig
     *
     * @param Tag $tags
     */
    public function __construct(
        string $bundleId,
        string $directoryId,
        VolumeEncryptionConfig $volumeEncryptionConfig,
        string $username,
        WorkspacePropertyConfig $workspacePropertyConfig,
        Tag ...$tags)
    {
        $this->m_username = $username;
        $this->m_bundleId = $bundleId;
        $this->m_directoryId = $directoryId;
        $this->m_workspacePropertyConfig = $workspacePropertyConfig;
        $this->m_volumeEncryptionConfig = $volumeEncryptionConfig;
        $this->m_tags = $tags;
    }


    public function toArray() : array
    {
        if ($this->m_tags === null)
        {
            $this->m_tags = array();
        }

        $arrayForm = [
            'BundleId' => $this->m_bundleId,
            'DirectoryId' => $this->m_directoryId,
            'UserName' => $this->m_username,
            'WorkspaceProperties' => $this->m_workspacePropertyConfig,
            'Tags' => $this->m_tags,
        ];

        $arrayForm = array_merge($arrayForm, $this->m_volumeEncryptionConfig->toArray());
        return $arrayForm;
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
