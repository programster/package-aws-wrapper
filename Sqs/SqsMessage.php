<?php

namespace Programster\AwsWrapper\Sqs;


class SqsMessage implements \JsonSerializable
{
    private $m_messageId;
    private $m_receiptHandle;
    private $m_bodyMd5;
    private $m_arrayForm;
    private $m_body;
    private $m_attributes;


    private function __construct()
    {

    }


    public static function createFromArray(array $arrayForm) : SqsMessage
    {
        $sqsMessage = new SqsMessage();
        $sqsMessage->m_arrayForm = $arrayForm;
        $sqsMessage->m_messageId = $arrayForm['MessageId'];
        $sqsMessage->m_receiptHandle = $arrayForm['ReceiptHandle'];
        $sqsMessage->m_bodyMd5 = $arrayForm['MD5OfBody'];
        $sqsMessage->m_body = $arrayForm['Body'];
        $sqsMessage->m_attributes = $arrayForm['Attributes'];

        return $sqsMessage;
    }


    public function jsonSerialize()
    {
        return $this->m_arrayForm;
    }


    # Accessors
    public function getId() : string { return $this->m_messageId; }
    public function getReceiptHandle() : string { return $this->m_receiptHandle; }
    public function getBodyMd5() : string { return $this->m_bodyMd5; }
    public function getBody() : string { return $this->m_body; }
    public function getAttributes() : array { return $this->m_attributes; }
}

