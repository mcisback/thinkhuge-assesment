<?php

/**
 * Get an environment variable with an optional default.
 *
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function _env(string $key, mixed $default = null): mixed
{
    $value = $_ENV[$key] ?? getenv($key);

    if ($value === false || $value === null) {
        return $default;
    }

    // Convert string booleans and nulls
    return match (strtolower($value)) {
        'true'  => true,
        'false' => false,
        'null'  => null,
        default => $value,
    };
}