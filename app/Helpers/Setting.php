<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class Setting
{
    /**
     * @param $value
     *
     * @return string
     */
    public static function get($key)
    {
        $settings = Cache::rememberForever('appSettings', function () {
            return json_decode(file_get_contents(storage_path() . "/app/settings.json"), true);
        });

        return $settings[$key];
    }
}
