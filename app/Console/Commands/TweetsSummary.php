<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TweetsSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tweets_summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates tweets summary';

    /**
     * Create a new command instance.
     *
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

    }
}
