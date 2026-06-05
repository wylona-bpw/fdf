<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    /**
     * Raccourci pour récupérer une valeur de Setting.
     * Usage dans Blade : {{ setting('site_name') }}
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}
