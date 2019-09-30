<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EventService;
use App\Models\Event;
use Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Repositories\EventRepository;

class ExportController extends Controller
{
    protected $service;
    protected $repository;

    public function __construct(EventRepository $repository, EventService $service)
    {
        $this->repository = $repository;
        $this->service    = $service;
    }

    public function exportAll(){
        $events =  $this->repository->findWhere(['user_id' =>  Auth::user()->id]);   
        Excel::create('events', function($excel) use($events) {
            $excel->sheet('ExportFile', function($sheet) use($events) {
                $sheet->fromArray($events);
            });
        })->export('csv');
  
      }

    public function exportToday(){
      $events = Event::whereDate('start_date', Carbon::today())
                        ->where('user_id', Auth::user()->id)
                        ->get();
      Excel::create('events', function($excel) use($events) {
          $excel->sheet('ExportFile', function($sheet) use($events) {
              $sheet->fromArray($events);
          });
      })->export('csv');

    }

    public function exportnextFive(){
        $events = Event::whereDate('start_date', '<=', Carbon::today()->addDay(5))
                    ->whereDate('start_date', '>=', Carbon::today())
                    ->where('user_id', Auth::user()->id)
                    ->get();   
        Excel::create('events', function($excel) use($events) {
            $excel->sheet('ExportFile', function($sheet) use($events) {
                $sheet->fromArray($events);
            });
        })->export('csv');
  
      } 
      public function import(Request $request)
      {
          $returnService = $this->service->import($request);
          return  $returnService;
  
      }
}
