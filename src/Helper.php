<?php

namespace Guestcms\DevTool;

class Helper
{
    public static function joinPaths(array $paths): string
    {
        return implode(DIRECTORY_SEPARATOR, $paths);
    }
}
