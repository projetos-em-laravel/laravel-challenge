<?php

namespace App\Services;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\EventRepository;
use App\Models\Event;
use App\Validators\EventValidator;
use Excel;

class ExportService{

    private $repository;
    private $validator;

    public function __construct(EventRepository $repository, EventValidator $validator) {

        $this->repository   = $repository;
        $this->validator    = $validator;
    }

    public function import($data)
    {
        try {

            if($data->file('imported-file'))
            {
                    $path = $data->file('imported-file')->getRealPath();
                    $data = Excel::load($path, function($reader) {
                })->get();
    
                if(!empty($data) && $data->count())
            {
            $data = $data->toArray();
            for($i=0;$i<count($data);$i++)
            {
                $this->validator->with($data[$i])->passesOrFail(ValidatorInterface::RULE_CREATE);
                $dataImported[] = $data[$i];
            }
                }
              

            Event::insert($dataImported);
            }
                     
            $returnService = redirect()->back()->with('success', 'Import Success!!!');
            return $returnService;

        } catch (ValidatorException $e) {  
            $returnService = redirect()->back()->withErrors($e->getMessageBag())->withInput();
            return $returnService;
        }

    }
}
