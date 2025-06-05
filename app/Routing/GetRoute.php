<?php

namespace App\Routing;

use Symfony\Component\Routing\Route;

class GetRoute extends Route
{
    public function __construct(
        string $path,
        array $defaults = [],
        array $requirements = [],
        array $options = [],
        string $host = '',
        array $schemes = [],
        string $condition = ''
    ) {
        parent::__construct(
            $path,
            $defaults,
            $requirements,
            $options,
            $host,
            $schemes,
            ['GET'],
            $condition
        );
    }
}
