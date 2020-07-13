<?php

namespace Programster\AwsWrapper\ElasticTranscoder;



class ResponseCreateJob
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

        if ($metadata['statusCode'] === 201)
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
     * @return bool
     */
    public function isOk() : bool
    {
        return $this->m_responseCode === 201;
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