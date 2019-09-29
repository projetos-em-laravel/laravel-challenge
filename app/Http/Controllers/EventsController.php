<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventCreateRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Mail\SendInvitation;
use App\Repositories\EventRepository;
use App\Services\EventService;
use App\Validators\EventValidator;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Response;

/**
 * Class EventsController.
 *
 * @package namespace App\Http\Controllers;
 */
class EventsController extends Controller
{
    protected $repository;
    protected $validator;
    protected $service;

    public function __construct(EventRepository $repository, EventValidator $validator, EventService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service    = $service;
    }

    public function index()
    {
        $eventsToday = $this->service->eventsToday(Auth::user()->id);

        $eventsNextFiveDays = $this->service->eventsNextFiveDays(Auth::user()->id);
                        
        $eventsAll = $this->repository->findWhere(['user_id' =>  Auth::user()->id]);
        
        return view('events.index')->with(['eventsToday' => $eventsToday , 'eventsNextFiveDays' => $eventsNextFiveDays, 'eventsAll' => $eventsAll]);
    }

    public function create()
    {
        return view('events.create');    
    }

    public function store(EventCreateRequest $request)
    {   
        $returnService = $this->service->store($request);
        return $returnService;
    }

 
    public function show($id)
    {
        $event = $this->repository->find($id);

        return view('events.show', compact('event'));
    }


    public function edit($id)
    {
        $event = $this->repository->find($id);
        
        return view('events.edit', compact('event'));
    }
 
    public function update(EventUpdateRequest $request, $id)
    {
        $returnService = $this->service->update($request, $id);
        return $returnService;
    }

    public function send(Request $request)
    {
        $title        = $request->title;
        $description  = $request->description;
        $start_date   = $request->start_date;
        $start_time   = $request->start_time;
        $end_date     = $request->end_date;
        $end_time     = $request->end_time;
        $email        = $request->email;
        $email_body   = $request->email_body;

        $rules = array(
            'email' => 'required|email',
            'email_body' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        
        // Enviando o e-mail
        Mail::to($email)->send(new SendInvitation( $title, $description, $start_date, $start_time, $end_date, $end_time, $email, $email_body ));

        if ($validator->fails())
        return response::json(array('errors'=> $validator->getMessageBag()->toarray()));


    }

    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        return redirect()->back()->with('message', 'Event deleted.');
    }
}
