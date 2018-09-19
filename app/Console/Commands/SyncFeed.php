<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Jo\Synchronisation\FeedsSynchroniser;

class SyncFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feeds:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncs all subscribed feeds';


    /**
     * The object responsible to synchronise feeds
     *
     * @var FeedsSynchroniser
     */
    protected $syncEngine;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FeedsSynchroniser $syncEngine)
    {
        parent::__construct();

        $this->syncEngine = $syncEngine;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->syncEngine->syncAll();
    }
}
