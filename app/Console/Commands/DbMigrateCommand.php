<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

class DbMigrateCommand extends Command
{
    private RouteCollection $routes;

    public function __construct()
    {
        // Load routes manually (adjust path if needed)
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Migrate the database');
        $this->setName( 'db:migrate' );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try{
            foreach (glob( config('app.paths.migrations') . '/*.php' ) as $path) {
                $migration = basename(dirname($path)) . '/' . basename($path);

                $output->writeln("[+] Running $migration");

                require_once $path;
            }

        } catch(\Exception $e) {
            $output->writeln($e->getMessage());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
