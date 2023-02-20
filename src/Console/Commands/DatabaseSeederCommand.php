<?php

namespace Jeodns\PDNSManager\Console\Commands;

use Illuminate\Console\Command;
use Jeodns\Database\Seeders\DatabaseSeeder;

class DatabaseSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PDNSManager:dbseed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run PDNSManager Package Database Seeder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new DatabaseSeeder())->run();

        return Command::SUCCESS;
    }
}
