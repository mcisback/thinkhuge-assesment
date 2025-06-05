<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

use App\Seeders\DatabaseSeeder;

class DbSeederCommand extends Command
{
    private RouteCollection $routes;

    public function __construct()
    {
        // Load routes manually (adjust path if needed)
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Seed the database');
        $this->setName( 'db:seed' );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try{
            $seeder = new DatabaseSeeder();

            $seeder->run();
        } catch(\Exception $e) {
            $output->writeln($e->getMessage());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
