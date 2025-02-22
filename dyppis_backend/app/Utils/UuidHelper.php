<?php

namespace App\Utils;

use Illuminate\Support\Str;
use Random\RandomException;

class UuidHelper
{
    /**
     *  Check text is UUID.
     *
     *  @param string $text
     *  @return bool
     */
    public static function isUuid(string $text): bool
    {
        return preg_match('/^[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}$/', $text) === 1;
    }

    /**
     *  Generate the UUID
     *
     *  @return string
     */
    public static function generateUuid(): string
    {
        return Str::uuid()->toString();
    }
}
