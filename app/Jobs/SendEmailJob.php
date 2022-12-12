<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmailDemo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $send_mail;
    protected $email;
    protected $agent_email;


    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($send_mail,$email,$agent_email)
    {
        $this->send_mail = $send_mail;
        $this->email = $email;
        $this->agent_email = $agent_email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->cc($this->agent_email)->bcc('info@garibook.com')->send(new SendEmailDemo($this->send_mail));
        // if(!Mail::failures()){
        //     //Unlink the attachement file from local
            unlink($this->send_mail);
        
        //     //delete file from storage
        //     Storage::delete($this->send_mail);//Uncomment this, if using storage
        // }
    }
}
