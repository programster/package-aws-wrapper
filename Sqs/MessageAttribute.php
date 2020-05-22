<?php

/*
 * An object for part of a SQS message.
 * https://docs.aws.amazon.com/AWSSimpleQueueService/latest/SQSDeveloperGuide/sqs-message-attributes.html
 */

namespace Programster\AwsWrapper\Sqs;

class MessageAttribute implements \JsonSerializable
{
    private $m_name; // the name for the attribute (attributes are just name/value pairs at end of the day).
    private $m_dataType;
    private $m_binaryListValues; // string || resource || Psr\Http\Message\StreamInterface>
    private $m_binaryValue; // string || resource || Psr\Http\Message\StreamInterface
    private $m_stringListValues; // ['<string>', ...],
    private $m_stringValue;


    private function __construct()
    {
    }


    public static function createFromArray(string $name, array $arrayForm)
    {
        $this->m_name = $name;
        $this->m_dataType = $arrayForm['DataType'];
        $this->m_binaryListValues = isset($arrayForm['BinaryListValues']) ? $arrayForm['BinaryListValues'] : null;
        $this->m_binaryValue = isset($arrayForm['BinaryValue']) ? $arrayForm['BinaryValue'] : null;
        $this->m_stringListValues = isset($arrayForm['StringListValues']) ? $arrayForm['StringListValues'] : null;
        $this->m_stringValue = isset($arrayForm['StringValue']) ? $arrayForm['StringValue'] : null;
    }


    public function toArray() : array
    {
        $bodyArray = ['DataType' => $this->m_dataType];

        if ($this->m_binaryListValues !== null) { $bodyArray['BinaryListValues'] = $this->m_binaryListValues; }
        if ($this->m_binaryValue !== null)      { $bodyArray['BinaryValue'] = $this->m_binaryValue;}
        if ($this->m_stringListValues !== null) { $bodyArray['StringListValues'] = $this->m_stringListValues; }
        if ($this->m_stringValue !== null)      { $bodyArray['StringValue'] = $this->m_stringValue; }

        $arrayForm = ['name' => $bodyArray];
        return $arrayForm;
    }


    public function jsonSerialize()
    {
        return $this->toArray();
    }


    # Accessors
    public function getDataType() : string { return $this->m_dataType; }
    public function getBinaryListValues() { return $this->m_binaryListValues; }
    public function getBinaryValue() { return $this->m_binaryValue; }
    public function getStringListValues() { return $this->m_stringListValues; }
    public function getStringValue() { return $this->m_stringValue; }
}
