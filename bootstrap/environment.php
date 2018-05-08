<?php

/**
 * @param string $property
 * @param mixed $default
 * @return mixed|null
 */
function environment(string $property, $default = null)
{
    $filename = path(APP_ROOT, '.env');
    if (!file_exists($filename) || !is_file($filename)) {
        return $default;
    }
    $properties = parse_ini_file($filename);
    if (!is_array($properties)) {
        return $default;
    }
    return get($properties, $property);
}