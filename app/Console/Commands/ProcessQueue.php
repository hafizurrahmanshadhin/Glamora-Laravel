<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ProcessQueue extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process queued jobs, including sending emails, etc.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        // Run the queue worker
        Artisan::call('queue:work', ['--stop-when-empty' => true]);

        $this->info('Queue processed successfully.');

        return 0;
    }
}
