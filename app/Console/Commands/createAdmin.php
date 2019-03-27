<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {--email=​admin@admin.com}{--password=123456}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an Admin account';

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
        $email = $this->option('email');
        $password = $this->option('password');
        
        if(User::where('email', '=', $email)->exists()){
            $this->info('Admin Email is already taken');
        }else{
            User::create([
                "name" => "Admin",
                "email" => $email,
                "password" => Hash::make($password),
                "image" => "temp/adminphoto",
                "banned" => 0,
            ]);
            $this->info('Admin Created Successfully');
        }
        
    }
}
