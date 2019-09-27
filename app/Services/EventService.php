<?php

namespace App\Services;

use App\Repositories\EventRepository;
use App\Validators\EventValidator;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EventService{

    private $repository;
    private $validator;

    public function __construct(EventRepository $repository, EventValidator $validator) {

        $this->repository   = $repository;
        $this->validator    = $validator;
    }

    public function eventsToday($data){
        $eventsToday = Event::whereDate('start_datetime', Carbon::today())
                        ->where('user_id', $data)
                        ->get();
        
        return $eventsToday;                
    }

    public function eventsNextFiveDays($data){
        $eventsNextFiveDays = Event::whereDate('start_datetime', '<=', Carbon::today()->addDay(5))
                        ->whereDate('start_datetime', '>=', Carbon::today())
                        ->where('user_id', $data)
                        ->get();   
        return $eventsNextFiveDays;   
    }


    

}