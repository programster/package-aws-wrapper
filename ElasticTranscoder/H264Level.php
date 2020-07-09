<?php

/*
 * This is essentially an ENUM to allow the developer to know what legit values are, and prevent mistakes.
 */

namespace Programster\AwsWrapper\ElasticTranscoder;


class H264Level
{
    private $m_value;


    private function __construct(string $value)
    {
        $this->m_value = $value;
    }


    public static function create1() : H264Level { return new H264Level("1"); }
    public static function create1b() : H264Level { return new H264Level("1b"); }
    public static function create1_1() : H264Level { return new H264Level("1.1"); }
    public static function create1_2() : H264Level { return new H264Level("1.2"); }
    public static function create1_3() : H264Level { return new H264Level("1.3"); }
    public static function create2() : H264Level { return new H264Level("2"); }
    public static function create2_1() : H264Level { return new H264Level("2.1"); }
    public static function create2_2() : H264Level { return new H264Level("2.2"); }
    public static function create3() : H264Level { return new H264Level("3"); }
    public static function create3_1() : H264Level { return new H264Level("3.1"); }
    public static function create3_2() : H264Level { return new H264Level("3.2"); }
    public static function create4() : H264Level { return new H264Level("4"); }
    public static function create4_1() : H264Level { return new H264Level("4.1"); }



    public function __toString()
    {
        return $this->m_value;
    }
}

