<?php

namespace sked\Console\Commands;

use Illuminate\Console\Command;
use sked\Event;
use sked\Http\Controllers\EmailSender;

class CheckDeadlines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'decrease:minutes';

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

        $events = Event::where('status', '=', '1')->get();

        foreach($events as $event){

            $event->remaining_minutes--;

            if($event->remaining_minutes == 0){

                $event->status = 0;
                EmailSender::notifyAdmin($event->id);

            }
            $event->update();
        }
    }
}
