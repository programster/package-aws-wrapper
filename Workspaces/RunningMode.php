<?php

/*
 *
 */

namespace Programster\AwsWrapper\Workspaces;


class RunningMode
{
    private $m_runningModeString;
    private $m_autoStopTimeoutInMinutes;


    private function __construct(string $runningMode, ?int $autoStopTimeoutInMinutes)
    {
        $this->m_runningMode = $runningMode;
        $this->m_autoStopTimeoutInMinutes = $autoStopTimeoutInMinutes;
    }


    /**
     * Use when paying a fixed monthly fee for unlimited usage of your WorkSpaces. This mode is best for users
     * who use their WorkSpace full time as their primary desktop.
     * @return \Programster\AwsWrapper\Workspaces\RunningMode
     */
    public function createAlwaysOn() : RunningMode
    {
        return new RunningMode('ALWAYS_ON', null);
    }


    /**
     * Use when paying for your WorkSpaces by the hour. With this mode, your WorkSpaces stop after a specified
     * period of inactivity, and the state of apps and data is saved. To set the automatic stop time,
     * use AutoStop Time (hours).
     * @param int $timeout - The time after a user logs off when WorkSpaces are automatically stopped.
     *                       Configured in 60-minute intervals.
     * @return \Programster\AwsWrapper\Workspaces\RunningMode
     */
    public function createAutoStop(int $timeout) : RunningMode
    {
        return new RunningMode('AUTO_STOP', $timeout);
    }


    public function toArray() : array
    {
        $arrayForm = ['RunningMode' => $this->m_runningModeString];

        if ($this->m_autoStopTimeoutInMinutes !== null)
        {
            $arrayForm['RunningModeAutoStopTimeoutInMinutes'] = $this->m_autoStopTimeoutInMinutes;
        }

        return $arrayFrom;
    }
}

