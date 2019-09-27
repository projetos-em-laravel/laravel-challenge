<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EventCreateRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Event;
use App\Repositories\EventRepository;
use App\Services\EventService;
use App\Validators\EventValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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


    public function store(EventCreateRequest $request)
    {
        
        try {
           
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $event = $this->repository->create($request->all());

            $response = [
                'message' => 'Event created.',
                'data'    => $event->toArray(),
            ];

            return redirect()->back()->with('success', $response['message']);
        } catch (ValidatorException $e) {
            
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

 
    public function show($id)
    {
        $event = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $event,
            ]);
        }

        return view('events.show', compact('event'));
    }


    public function edit($id)
    {
        $event = $this->repository->find($id);

        return view('events.edit', compact('event'));
    }

    public function create()
    {
        return view('events.create');    
    }
 
    public function update(EventUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $event = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Event updated.',
                'data'    => $event->toArray(),
            ];

            return redirect()->back()->with('success', $response['message']);
        } catch (ValidatorException $e) {

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Event deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Event deleted.');
    }
}
