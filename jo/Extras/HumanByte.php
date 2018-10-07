<?php

namespace Jo\Extras;

use ByteUnits\Binary;

class HumanByte extends Binary
{
    public function getHumanSize()
    {
        return $this->isGreaterThanOrEqualTo(Binary::megabytes(1))
            ? $this->format('MB', '/')
            : $this->format('kB', '/');
    }
}
