<?php

namespace App\Routing;

use Symfony\Component\Routing\Route;

class MixedRoute extends Route
{
    public function __construct(
        string $path,
        array $defaults = [],
        array $methods = [],
        array $requirements = [],
        array $options = [],
        string $host = '',
        array $schemes = [],
        string $condition = ''
    ) {
        $methods = $methods ?: ['GET'];
        
        parent::__construct(
            $path,
            $defaults,
            $requirements,
            $options,
            $host,
            $schemes,
            $methods,
            $condition
        );
    }
}
