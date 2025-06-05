<?php

function config($key, $default = null) {
    $_CONFIG = require_once __DIR__ . '/../config/config.php';

    return $_CONFIG[ $key ] ?? $default;
}