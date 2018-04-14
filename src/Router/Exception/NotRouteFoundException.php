<?php

namespace Router\Exception;

class NotRouteFoundException extends InvalidArgumentException
{
    public static function empty()
    {
        return new static('Route not found', 404);
    }
}