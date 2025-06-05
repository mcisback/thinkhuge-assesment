<?php

namespace App\Console;

use Symfony\Component\Console\Application;

class Kernel
{
    public function run(): void
    {
        $app = new Application('MarkFramework CLI', '1.0.0');

        $app->add(new \App\Console\Commands\RoutesListCommand());

        $app->run();
    }
}
