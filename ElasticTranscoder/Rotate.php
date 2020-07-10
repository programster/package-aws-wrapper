<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class Rotate
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    public static function create0() : Rotate { return new Rotate("0"); }
    public static function create90() : Rotate { return new Rotate("90"); }
    public static function create180() : Rotate { return new Rotate("180"); }
    public static function create270() : Rotate { return new Rotate("270"); }


    /**
     * The value auto generally works only if the file that you're transcoding contains rotation metadata.
     * Do not use this as a replacemnt to 0!
     * @return \Programster\AwsWrapper\ElasticTranscoder\Rotate
     */
    public static function createAuto() : Rotate { return new Rotate("auto"); }


    public function __toString()
    {
        return $this->m_value;
    }
}

