<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

class Role extends Enum
{
    private const SUPER_ADMIN = 'super-admin';
    private const ADMIN       = 'admin';

    /**
     * @return \App\Enums\Role
     */
    public static function ADMIN()
    {
        return new Role(self::ADMIN);
    }

    /**
     * @return \App\Enums\Role
     */
    public static function SUPER_ADMIN()
    {
        return new Role(self::SUPER_ADMIN);
    }
}