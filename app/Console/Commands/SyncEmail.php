<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Jo\Synchronisation\EmailsSynchroniser;

class SyncEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncs all email accounts';


    /**
     * The object responsible to synchronise emails
     *
     * @var EmailsSynchroniser
     */
    protected $syncEngine;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EmailsSynchroniser $syncEngine)
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
