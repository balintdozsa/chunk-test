<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CreateFileJob;

class CreateFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        for ($i = 0; $i < 65; $i++) {
            CreateFileJob::dispatch($i, 100000);
        }
    }
}
