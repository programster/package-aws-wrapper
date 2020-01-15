<?php

/* 
 * An interface for a class that will handle 
 */

namespace Programster\AwsWrapper\S3;

interface S3WalkerInterface
{
    public function handle(\Programster\AwsWrapper\Objects\S3Object $object) : void;
}
