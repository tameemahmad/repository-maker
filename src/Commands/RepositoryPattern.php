<?php

namespace Temify\RepositoryPattern\Commands;

use Illuminate\Console\Command;
use Temify\RepositoryPattern\Service\RepositoryService;

class RepositoryPattern extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repo {name : Class (Singular), e.g User, Prpduct, Image, Post}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Repository with a single command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        RepositoryService::ImplementNow($name);

        $this->info("Repository implemented for model ". $name);
    }
}
