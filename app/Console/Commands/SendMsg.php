<?php

namespace App\Console\Commands;

use App\Events\MessageSent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class SendMsg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:msg';

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
        //for ($i = 0; $i < 10; $i++) {
        //    event(new MessageSent('Test Message ' . ($i+1)));
        //}
        //Redis::set('asd', 'fgh');
        $data = [
            'event' => 'MessageSent',
            'data' => [
                'message' => 'JohnDoe'
            ]
        ];

        Redis::publish('test-channel', json_encode($data));

        return 'Done';
    }
}
