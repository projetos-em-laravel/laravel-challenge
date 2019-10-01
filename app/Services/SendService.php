<?php

namespace App\Services;

use App\Repositories\EventRepository;
use App\Validators\EventValidator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInvitation;
use Response;
use Validator;

class SendService{
    
    private $repository;
    private $validator;

    public function __construct(EventRepository $repository, EventValidator $validator) {

        $this->repository   = $repository;
        $this->validator    = $validator;
    }

    public function send($data){

        $title        = $data->title;
        $description  = $data->description;
        $start_date   = $data->start_date;
        $start_time   = $data->start_time;
        $end_date     = $data->end_date;
        $end_time     = $data->end_time;
        $email        = $data->email;
        $email_body   = $data->email_body;

        $rules = array(
            'email' => 'required|email',
            'email_body' => 'required',
        );

        $validator = Validator::make($data->all(), $rules);
        
        if ($validator->fails()){
            $returnService =  response::json(array('errors'=> $validator->getMessageBag()->toarray()));
            return $returnService;
        }else{
            // Enviando o e-mail
            Mail::to($email)->send(new SendInvitation( $title, $description, $start_date, $start_time, $end_date, $end_time, $email, $email_body ));
            $returnService =  response::json(array('success'=> 'Email successfully sent!'));
            return $returnService;
        }

    }
}