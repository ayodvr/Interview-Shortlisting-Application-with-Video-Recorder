<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\FileUploads;
use Carbon\Carbon;

class RemoveBlobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command to delete blobs';

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
     * @return int
     */
    public function handle()
    {
        FileUploads::where('updated_at', '<', Carbon::now()->subDays(5))->delete();
        \Log::info('Interview sessions have been cleared');
    }
}
