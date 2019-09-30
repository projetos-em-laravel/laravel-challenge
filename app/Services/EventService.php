<?php

namespace App\Services;

use App\Repositories\EventRepository;
use App\Validators\EventValidator;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInvitation;
use Validator;
use Response;

class EventService{

    private $repository;
    private $validator;

    public function __construct(EventRepository $repository, EventValidator $validator) {

        $this->repository   = $repository;
        $this->validator    = $validator;
    }

    public function eventsToday($data){
        $eventsToday = Event::whereDate('start_date', Carbon::today())
                        ->where('user_id', $data)
                        ->get();
        
        return $eventsToday;                
    }

    public function eventsNextFiveDays($data){
        $eventsNextFiveDays = Event::whereDate('start_date', '<=', Carbon::today()->addDay(5))
                        ->whereDate('start_date', '>=', Carbon::today())
                        ->where('user_id', $data)
                        ->get();   
        return $eventsNextFiveDays;   
    }

    public function store($data)
    {   
        //Getting the user logged in and transforming into array
        $user_logged = array("user_id" => Auth::user()->id);

        //Concatenating Request array with the logged in user array
        $requestEvent = array_merge($data->all(), $user_logged);
        
        try {
           
            $this->validator->with($requestEvent)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $event = $this->repository->create($requestEvent);

            $response = [
                'message' => 'Event created.',
                'data'    => $event->toArray(),
            ];

            $returnService = redirect()->back()->with('success', $response['message']);
            return $returnService;
        } catch (ValidatorException $e) {

            $returnService = redirect()->back()->withErrors($e->getMessageBag())->withInput();
            return $returnService;
        }
    }

    public function update($data, $id)
    {
        try {

            $this->validator->with($data->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $event = $this->repository->update($data->all(), $id);

            $response = [
                'message' => 'Event updated.',
                'data'    => $event->toArray(),
            ];

            $returnService = redirect()->back()->with('success', $response['message']);
            return $returnService;
        } catch (ValidatorException $e) {

            $returnService = redirect()->back()->withErrors($e->getMessageBag())->withInput();
            return $returnService;
        }
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