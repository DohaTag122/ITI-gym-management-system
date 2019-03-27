<?php

namespace App\Console\Commands;

use App\Member;
use App\Notifications\ReminderNotify;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:send_reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send reminder email for users ​ who didn’t login from the past month';

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
        //
        $users = Member::all();
        $Current_day = Carbon::now()->setTimezone('Africa/Cairo');

        foreach ($users as $user)
        {
            $diff_in_days = $Current_day->diffInDays($user->last_log_in);
            if($diff_in_days >= 30)
            {
                $user->notify(new ReminderNotify($user));
            }
        }

    }
}
