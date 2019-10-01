<?php

namespace App\Http\Controllers;

use App\Services\SendService;
use Illuminate\Http\Request;

class SendController extends Controller
{
    private $service;

    public function __construct(SendService $service) {
        $this->service   = $service;
    }
    public function send(Request $request)
    {
        $returnService = $this->service->send($request);
        return $returnService;

    }
}
