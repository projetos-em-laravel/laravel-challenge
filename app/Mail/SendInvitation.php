<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $description;
    public $start_date;
    public $start_time;
    public $end_date;
    public $end_time;
    public $email;
    public $email_body;

    public function __construct( $title, $description, $start_date, $start_time, $end_date, $end_time, $email, $email_body )
    {
        $this->title        = $title;
        $this->description  = $description;
        $this->start_date   = $start_date;
        $this->start_time   = $start_time;
        $this->end_date     = $end_date;
        $this->end_time     = $end_time;
        $this->email        = $email;
        $this->email_body   = $email_body;
    }

    public function build()
    {   
        return $this->from('laravelchallenge@gmail.com')
                ->subject('Hello! I invite you to our')
                ->view('events.emails.send');
    }
}
