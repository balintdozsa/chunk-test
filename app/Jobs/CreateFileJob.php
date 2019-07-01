<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $no;
    private $lineNo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($no, $lineNo)
    {
        $this->no = $no;
        $this->lineNo = $lineNo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lineNo = $this->lineNo;
        $content = '';
        print $this->no . '#' . ($this->no * $this->lineNo);

        $random_data = ['a000','b000','c000','d000','e000'];

        for ($i = 0; $i < $lineNo; $i++) {
            $line = ($this->no * $this->lineNo) + $i;
            for ($j = 0; $j < 15; $j++) {
                $line .= ';';

                if ($j === 0) {
                    $line .= $random_data[array_rand($random_data)];
                } else if ($j === 1) {
                    $line .= rand(1970,2000);
                } else {
                    $line .= Str::random(10);
                }
            }
            $line .= "\n";
            $content .= $line;

            if ($i === $lineNo-1) print '#' . ($this->no * $this->lineNo + $i) . "\n";
        }

        //Storage::append('file.csv', $content);

        $path = storage_path('app/file.csv');
        $fp = fopen($path, 'a');
        fwrite($fp, $content);
        fclose($fp);
    }
}
