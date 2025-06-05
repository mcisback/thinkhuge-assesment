<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

class RoutesListCommand extends Command
{
    private RouteCollection $routes;

    public function __construct()
    {
        // Load routes manually (adjust path if needed)
        $this->routes = require __DIR__ . '/../../../config/routes.php';
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Display all registered routes');
        $this->setName( 'route:list' );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $table = new Table($output);
        $table->setHeaders(['Name', 'Method(s)', 'Prefix', 'Path', 'Format']);

        foreach ($this->routes as $name => $route) {
            /** @var Route $route */
            $methods = implode('|', $route->getMethods() ?: ['ANY']);
            $table->addRow([
                $name,
                $methods,
                $route->getDefault('_prefix') ?? 'N.A.',
                $route->getPath(),
                $route->getDefault('_format') ?? 'N.A.',
            ]);
        }

        $table->render();

        return Command::SUCCESS;
    }
}
