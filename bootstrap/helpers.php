<?php

if (!function_exists('config_path')) {
    /**
     * Get the configuration path
     *
     * @param string $path
     * @return string
     */
    function config_path($path = '')
    {
        $output = app()->basePath() . '/config';
        if ($path) {
            $output .= "/$path";
        }
        return $output;
    }
}


if (!class_exists('Config')) {
    class_alias(\Illuminate\Support\Facades\Config::class, 'Config');
}

if (!class_exists('Response')) {
    class_alias(\Illuminate\Support\Facades\Response::class, 'Response');
}
