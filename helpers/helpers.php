<?php

// Autoload all helper files in the helpers/ directory
foreach (glob(__DIR__ . '/*.php') as $file) {
    if ($file !== __FILE__) {
        require_once $file;
    }
}
