<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Models\User;

class MakeUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {--name=} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

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
        $user = User::orderBy('id', 'desc')->first();
        $email = "sandy_".$user->id."@yopmail.com";
        $data = [
            'name'=>'sandy',
            'email'=> $email,
            'password' => bcrypt('abc123')
        ];
        $sendResult = User::create($data);
        if($sendResult) {
            die("User created successfully");
        }
        die("User not created");
    }
}
