<?php

namespace Programster\AwsWrapper\Sqs;



class ResponseRecieveMessage
{
    private $m_messages;
    private $m_responseCode;
    private $m_rawResponse;


    public function __construct(\Aws\Result $response)
    {
        $this->m_rawResponse = $response;
        $arrayForm = $response->toArray();
        $metadata = $arrayForm['@metadata'];
        $this->m_responseCode = $metadata['statusCode'];
        $this->m_messages = array();

        if ($metadata['statusCode'] === 200)
        {
            if (isset($arrayForm['Messages']) && count($arrayForm['Messages']) > 0)
            {
                $messages = $arrayForm['Messages'];

                foreach ($messages as $messageArray)
                {
                    $this->m_messages[] = SqsMessage::createFromArray($messageArray);
                }
            }
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
        return $this->m_responseCode === 200;
    }


    public function getMessages() : array
    {
        return $this->m_messages;
    }


    /**
     * Get the underlying aws response that this object was created from.
     * You may want this for debugging errors.
     * @return \Aws\Result
     */
    public function getRawResponse() : \Aws\Result { return $this->m_rawResponse; }
}