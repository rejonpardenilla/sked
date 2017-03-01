<?php

namespace sked\Console\Commands;

use Illuminate\Console\Command;
use sked\Guest;

class CheckDeadlines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:deadlines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if the deadline is over in an event';

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
        $g = new Guest();
        $g->event_id = 1;
        $g->email = 'prueba';
        $g->name = 'elde la prueba';
        $g->required = 1;
        $g->save();
    }
}
