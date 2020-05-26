<?php

/*
 * Client for interfacing with AWS Ec2
 * You may find this useful:
 * http://docs.aws.amazon.com/aws-sdk-php/v3/api/api-ec2-2015-04-15.html
 */

namespace Programster\AwsWrapper\Sqs;

class SqsClient
{
    private $m_client;


    public function __construct($apiKey, $apiSecret, \Programster\AwsWrapper\Enums\AwsRegion $region)
    {
        $credentials = array(
            'key'    => $apiKey,
            'secret' => $apiSecret
        );

        $params = array(
            'credentials' => $credentials,
            'version'     => '2012-11-05',
            'region'      => (string) $region,
        );

        $this->m_client = new \Aws\Sqs\SqsClient($params);
    }


    /**
     * Deletes the specified message from the specified queue.
     * To select the message to delete, use the ReceiptHandle of the message (not the MessageId which you
     * receive when you send the message). Amazon SQS can delete a message from a queue even if a visibility
     * timeout setting causes the message to be locked by another consumer. Amazon SQS automatically deletes
     * messages left in a queue longer than the retention period configured for the queue.
     *
     * The ReceiptHandle is associated with a specific instance of receiving a message.
     * If you receive a message more than once, the ReceiptHandle is different each time you receive a message.
     * When you use the DeleteMessage action, you must provide the most recently received ReceiptHandle for
     * the message (otherwise, the request succeeds, but the message might not be deleted).
     *
     * For standard queues, it is possible to receive a message even after you delete it.
     * This might happen on rare occasions if one of the servers which stores a copy of the message is
     * unavailable when you send the request to delete the message. The copy remains on the server and
     * might be returned to you during a subsequent receive request. You should ensure that your
     * application is idempotent, so that receiving a message more than once does not cause issues.

     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-sqs-2012-11-05.html#deletemessage
     */
    public function deleteMessage(string $queueUrl, string $receiptHandle)
    {
        $params = [
            'QueueUrl' => $queueUrl, // REQUIRED
            'ReceiptHandle' => $receiptHandle, // REQUIRED
        ];

        return $this->m_client->deleteMessage($params);
    }


    /**
     * Deletes the messages in a queue specified by the QueueURL parameter.
     * When you use the PurgeQueue action, you can't retrieve any messages deleted from a queue.
     * The message deletion process takes up to 60 seconds. We recommend waiting for 60 seconds regardless of your queue's size.
     * Messages sent to the queue before you call PurgeQueue might be received but are deleted within the next minute.
     * Messages sent to the queue after you call PurgeQueue might be deleted while the queue is being purged.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-sqs-2012-11-05.html#purgequeue
     *
     * @param string $queuUrl - The URL of the queue from which the PurgeQueue action deletes messages.
     * @return type
     */
    public function purgeQueue(string $queuUrl)
    {
        $params = array('QueueUrl' => $queuUrl);
        return $this->m_client->purgeQueue($params);
    }


    /**
     * Returns a list of your queues. The maximum number of queues that can be returned is 1,000.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-sqs-2012-11-05.html#listqueues
     *
     * @param string $queueNamePrefix - optionally provide a prefix to only return queues with a name that begins
     *                                  with the specified value.
     */
    public function listQueues(string $queueNamePrefix = "")
    {
        $params = ($queueNamePrefix !== "") ? ['QueueNamePrefix' => $queueNamePrefix] : [];
        return $this->m_client->listQueues($params);
    }


    /**
     * Retrieves one or more messages (up to 10), from the specified queue.
     * Using the WaitTimeSeconds parameter enables long-poll support. For more information, see Amazon SQS Long
     * Polling in the Amazon Simple Queue Service Developer Guide.
     * Short poll is the default behaviour where a weighted random set of machines is sampled on a ReceiveMessage call.
     * Thus, only the messages on the sampled machines are returned. If the number of messages in the queue is small
     * (fewer than 1,000), you most likely get fewer messages than you requested per ReceiveMessage call.
     * If the number of messages in the queue is extremely small, you might not receive any messages in a particular
     * ReceiveMessage response. If this happens, repeat the request.
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-sqs-2012-11-05.html#receivemessage
     *
     * @param string $queueUrl
     * @param int $visibilityTimeout
     * @param int $maxNumMessages - optionally specify the max number of messages to receive. This defaults to 1, but
     *                              can be up to 10.     * @param int $waitTimeSeconds
     * @param string $receiveRequestAttemptId
     * @return type
     */
    public function recieveMessage(
        string $queueUrl,
        int $visibilityTimeout,
        int $maxNumMessages = 1,
        int $waitTimeSeconds = 0,
        string $receiveRequestAttemptId = ""
    ) : ResponseRecieveMessage
    {
        if ($maxNumMessages > 10) { $maxNumMessages = 10; }
        if ($maxNumMessages < 1) { $maxNumMessages = 1; }

        $params = [
            'QueueUrl' => $queueUrl, // REQUIRED
            'AttributeNames' => ['All'],
            'MaxNumberOfMessages' => $maxNumMessages,
            'VisibilityTimeout' => $visibilityTimeout,
            'WaitTimeSeconds' => $waitTimeSeconds,
        ];

        if ($receiveRequestAttemptId !== "")
        {
            $params['ReceiveRequestAttemptId'] = $receiveRequestAttemptId;
        }

        $awsResponse = $this->m_client->receiveMessage($params);
        return new ResponseRecieveMessage($awsResponse);
    }


    /**
     * Delivers a message to the specified queue.
     * A message can include only XML, JSON, and unformatted text. The following Unicode characters are allowed:
     *     #x9 | #xA | #xD | #x20 to #xD7FF | #xE000 to #xFFFD | #x10000 to #x10FFFF
     * Any characters not included in this list will be rejected. For more information, see the W3C specification for
     * characters: http://www.w3.org/TR/REC-xml/#charsets
     * https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-sqs-2012-11-05.html#sendmessage
     *
     * @param string $messageBody - The message to send. The maximum string size is 256 KB.
     *
     * @param string $queueUrl - The URL of the Amazon SQS queue to which a message is sent.
     *
     * @param int|null $delaySeconds - optionally specify the length of time, in seconds, for which to delay a
     *      specific message. Valid values: 0 to 900. Maximum: 15 minutes. Messages with a positive DelaySeconds
     *      value become available for processing after the delay period is finished. If you don't specify a value,
     *      the default value for the queue applies.
     *      When you set FifoQueue, you can't set DelaySeconds per message. You can set this parameter only on a
     *      queue level.
     *
     * @param string|null $messageGroupId - This parameter applies only to FIFO (first-in-first-out) queues.
     *      The tag that specifies that a message belongs to a specific message group. Messages that belong to the
     *      same message group are processed in a FIFO manner (however, messages in different message groups might
     *      be processed out of order). To interleave multiple ordered streams within a single queue, use
     *      MessageGroupId values (for example, session data for multiple users). In this scenario, multiple
     *      consumers can process the queue, but the session data of each user is processed in a FIFO fashion.
     *
     * @param string|null $messageDeduplicationId - This parameter applies only to FIFO (first-in-first-out) queues.
     *      The token used for deduplication of sent messages. If a message with a
     *      particular MessageDeduplicationId is sent successfully, any messages sent with the same
     *      MessageDeduplicationId are accepted successfully but aren't delivered during the 5-minute deduplication
     *      interval. For more information, see Exactly-Once Processing in the Amazon Simple Queue Service Developer
     *      Guide.
     */
    public function sendMessage(
        string $messageBody,
        string $queueUrl,
        ?int $delaySeconds,
        ?string $messageGroupId,
        ?string $messageDeduplicationId
    )
    {
        $params = [
            'MessageBody' => $messageBody,
            'QueueUrl' => $queueUrl,
        ];

        if ($messageGroupId !== null)
        {
            $params['MessageGroupId'] = $messageGroupId;
        }

        if ($messageDeduplicationId !== null)
        {
            $params['MessageDeduplicationId'] = $messageDeduplicationId;
        }

        if ($delaySeconds !== null)
        {
            $params['DelaySeconds'] = $delaySeconds;
        }

        return $this->m_client->sendMessage($params);
    }
}