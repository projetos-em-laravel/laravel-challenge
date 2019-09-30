<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventCreateRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Mail\SendInvitation;
use App\Models\Event;
use App\Repositories\EventRepository;
use App\Services\EventService;
use App\Validators\EventValidator;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Response;
use Excel;
use Carbon\Carbon;

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
        $returnService = $this->service->send($request);
        return $returnService;

    }

    public function destroy($id)
    {
        $event = $this->repository->find($id);
        $event->delete();

        return response::json($event);
    }
}
