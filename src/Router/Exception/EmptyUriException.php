<?php

namespace Router\Exception;

class EmptyUriException extends InvalidArgumentException
{
    public static function empty()
    {
        return new static('Route cannot be empty', 404);
    }
}