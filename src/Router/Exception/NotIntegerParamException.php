<?php

namespace Router\Exception;

class NotIntegerParamException extends InvalidArgumentException
{
    public static function empty()
    {
        return new static('Param not integer', 500);
    }
}
