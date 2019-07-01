<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ReadFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'read:file';

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
        $path = storage_path('app/file.csv');
        $handle = fopen($path, 'r');

        print memory_get_usage() / 1024 / 1024;

        $aggr = [];
        $aggr['type'] = [];
        $aggr['year'] = [];

        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            //$num = count($data);
            //print $data[0]."\n";

            !isset($aggr['type'][$data[1]]) ? $aggr['type'][$data[1]] = 0 : null;
            $aggr['type'][$data[1]]++;

            !isset($aggr['year'][$data[2]]) ? $aggr['year'][$data[2]] = 0 : null;
            $aggr['year'][$data[2]]++;
        }

        print memory_get_usage() / 1024 / 1024;
        print_r($aggr);
    }
}
