<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to all users';

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
        $user = User::find(1)->toArray();

        \Mail::send('emails.email', $user, function($message) use ($user) {
            $message->to("suzanaristova@yahoo.com");
            $message->subject('Blog');
        });
    }
}
