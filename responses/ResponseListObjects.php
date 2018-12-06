<?php

namespace Programster\AwsWrapper\Responses;

/*
 * A response for a request to list objects.
 */

class ResponseListObjects
{
    private $m_objects = [];
    private $m_isTruncated;
    
    public function __construct(\Aws\Result $result)
    {
        $this->m_isTruncated = $result->get('IsTruncated');
        $contents = $result->get('Contents');
        
        foreach ($contents as $content) {
            $this->m_objects[] = new \Programster\AwsWrapper\Objects\S3Object($content);
        }
    }
    
    
    # Accessors
    public function getObjects() : array { return $this->m_objects; }
    public function isTruncated() : bool { return $this->m_isTruncated; }
}

/*
 * object(Aws\Result)#110 (1) {
  ["data":"Aws\Result":private]=>
  array(8) {
    ["IsTruncated"]=>
    bool(false)
    ["Marker"]=>
    string(0) ""
    ["Contents"]=>
    array(2) {
      [0]=>
      array(6) {
        ["Key"]=>
        string(8) "folder1/"
        ["LastModified"]=>
        object(Aws\Api\DateTimeResult)#122 (3) {
          ["date"]=>
          string(26) "2018-12-06 09:24:55.000000"
          ["timezone_type"]=>
          int(2)
          ["timezone"]=>
          string(1) "Z"
        }
        ["ETag"]=>
        string(34) ""d41d8cd98f00b204e9800998ecf8427e""
        ["Size"]=>
        int(0)
        ["StorageClass"]=>
        string(8) "STANDARD"
        ["Owner"]=>
        array(2) {
          ["DisplayName"]=>
          string(7) "support"
          ["ID"]=>
          string(64) "7b3452424b0c2fac4c2a2f503975c4417d9dea29d6af37e1f96290b01a280ab5"
        }
      }
      [1]=>
      array(6) {
        ["Key"]=>
        string(33) "folder1/gitlab-burndown-issue.png"
        ["LastModified"]=>
        object(Aws\Api\DateTimeResult)#125 (3) {
          ["date"]=>
          string(26) "2018-12-06 11:42:20.000000"
          ["timezone_type"]=>
          int(2)
          ["timezone"]=>
          string(1) "Z"
        }
        ["ETag"]=>
        string(34) ""954161d867b0955322ed0e2ff2fe934f""
        ["Size"]=>
        int(79145)
        ["StorageClass"]=>
        string(8) "STANDARD"
        ["Owner"]=>
        array(2) {
          ["DisplayName"]=>
          string(7) "support"
          ["ID"]=>
          string(64) "7b3452424b0c2fac4c2a2f503975c4417d9dea29d6af37e1f96290b01a280ab5"
        }
      }
    }
    ["Name"]=>
    string(14) "di-test-bucket"
    ["Prefix"]=>
    string(8) "folder1/"
    ["MaxKeys"]=>
    int(1000)
    ["EncodingType"]=>
    string(3) "url"
    ["@metadata"]=>
    array(4) {
      ["statusCode"]=>
      int(200)
      ["effectiveUri"]=>
      string(99) "https://s3-eu-west-1.amazonaws.com/di-test-bucket?max-keys=1000&prefix=folder1%2F&encoding-type=url"
      ["headers"]=>
      array(7) {
        ["x-amz-id-2"]=>
        string(76) "JRJwr2bkctj8PsscszrU1ERUzJKN7JS1Q6o5c+eMvQnBywwnt2c46DqKbQq77uYci1mR6qWoJNQ="
        ["x-amz-request-id"]=>
        string(16) "339A33542AFF9C76"
        ["date"]=>
        string(29) "Thu, 06 Dec 2018 11:43:07 GMT"
        ["x-amz-bucket-region"]=>
        string(9) "eu-west-1"
        ["content-type"]=>
        string(15) "application/xml"
        ["server"]=>
        string(8) "AmazonS3"
        ["connection"]=>
        string(5) "close"
      }
      ["transferStats"]=>
      array(1) {
        ["http"]=>
        array(1) {
          [0]=>
          array(0) {
          }
        }
      }
    }
  }
}

 */

