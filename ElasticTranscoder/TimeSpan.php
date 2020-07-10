<?php

/*
 * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-elastictranscoder-2012-09-25.html#shape-timespan
 */


namespace Programster\AwsWrapper\ElasticTranscoder;


class TimeSpan implements \JsonSerializable
{
    protected $m_arrayForm;


    /**
     *
     * @param string $duration - The duration of the clip. The format can be either HH:mm:ss.SSS
     *      (maximum value: 23:59:59.999; SSS is thousandths of a second) or sssss.SSS (maximum value: 86399.999).
     *      If you don't specify a value, Elastic Transcoder creates an output file from StartTime to the end of the
     *      file.
     *      If you specify a value longer than the duration of the input file, Elastic Transcoder transcodes the file
     *      and returns a warning message.
     *
     * @param string $startTime - The place in the input file where you want a clip to start. The format can be
     *      either HH:mm:ss.SSS (maximum value: 23:59:59.999; SSS is thousandths of a second)
     *      or sssss.SSS (maximum value: 86399.999).
     *      If you don't specify a value, Elastic Transcoder starts at the beginning of the input file.
     */
    protected function __construct(?string $startTime, ?string $duration)
    {
        $this->m_arrayForm = array();

        if ($startTime !== null)
        {
            $this->m_arrayForm['StartTime'] = $startTime;
        }

        if ($duration !== null)
        {
            $this->m_arrayForm['Duration'] = $duration;
        }
    }


    public function toArray()
    {
        return $this->m_arrayForm;
    }
    

    public function jsonSerialize()
    {
        return $this->m_arrayForm;
    }
}



