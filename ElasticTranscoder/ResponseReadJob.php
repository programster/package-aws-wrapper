<?php

/*
 * A response for a read request on a job.
 * This is mostlythe same as a response for creating a job, except that when successful, the code is 200 instead of 201
 * because 201 is for when something got created.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;



class ResponseReadJob
{
    private $m_job;
    private $m_responseCode;
    private $m_rawResponse;


    public function __construct(\Aws\Result $response)
    {
        $this->m_rawResponse = $response;
        $arrayForm = $response->toArray();
        $metadata = $arrayForm['@metadata'];
        $this->m_responseCode = $metadata['statusCode'];

        if ($metadata['statusCode'] === 200)
        {
            // successfully created meeting
            $this->m_job = TranscodeJob::createFromArray($arrayForm['Job']);
        }
        else
        {
            // handle here.
        }
    }


    /**
     * Find out if the response is okay. E.g. no errors.
     * WARNING - isOk will return successful if the request to read a job was successful. However, this does NOT
     * indicate whether the transcode completed successfully, just that we were able to read the job successfully.
     * If the job failed to transcode, check use job->getStatus() to see if it has a value of "Error". If so, then
     * details of what went wrong will be in the "output", "outputs" and possibly "playlist" attributes.
     *
     * @return bool
     */
    public function isOk() : bool
    {
        return $this->m_responseCode === 200;
    }


    /**
     * Returns the meeting that was returned in the response object.
     * @return \Programster\AwsWrapper\Chime\ChimeMeeting
     * @throws \Exception - if there is no meeting
     */
    public function getJob() : TranscodeJob
    {
        if ($this->m_job === null)
        {
            throw new \Exception("Create job response was unsuccessful. There is no job.");
        }

        return $this->m_job;
    }


    /**
     * Get the underlying aws response that this object was created from.
     * You may want this for debugging errors.
     * @return \Aws\Result
     */
    public function getRawResponse() : \Aws\Result { return $this->m_rawResponse; }
}