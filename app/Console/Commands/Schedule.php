<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Schedule extends Command
{
    protected $signature = 'schedule:run';

    protected $description = 'Command description';

    public function handle()
    {
        $this->info('Schedule command executed successfully.');
    }
}
