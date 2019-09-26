<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;

class UserService{
    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator) {

        $this->repository   = $repository;
        $this->validator    = $validator;
    }

    public function update($data, $id)
    {

        try {

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            
            $user = $this->repository->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ], $id);

            $response = [
                'message' => 'Profile changed successfully !',
                'data'    => $user->toArray(),
            ]; 
        
            $returnService = redirect()->back()->with('success', $response['message']);
            return $returnService;
        } catch (ValidatorException $e) {

            $returnService = redirect()->back()->withErrors($e->getMessageBag())->withInput();
            return $returnService;
        }
    }
}