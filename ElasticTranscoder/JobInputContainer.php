<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class JobInputContainer extends VideoContainer
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    public static function createAuto() : JobInputContainer { return new JobInputContainer("auto"); }

    public static function create3gp() : JobInputContainer { return new JobInputContainer("3gp"); }
    public static function createAAC() : JobInputContainer { return new JobInputContainer("AAC"); }
    public static function createMp3() : JobInputContainer { return new JobInputContainer("mp3"); }
    public static function createM4A() : JobInputContainer { return new JobInputContainer("m4a"); }
    public static function createWav() : JobInputContainer { return new JobInputContainer("wav"); }



    public function __toString()
    {
        return $this->m_value;
    }
}

