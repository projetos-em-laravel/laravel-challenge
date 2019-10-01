<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Validator;
use Illuminate\Support\Facades\Auth;

class UserService{
    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator) {

        $this->repository   = $repository;
        $this->validator    = $validator;
    }

    public function update($data, $id)
    {

            $rules = array(
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' .Auth::user()->id,
                'password' => 'required|string|min:6|confirmed',
            );
    
            $validator = Validator::make($data, $rules);$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
           
            if (!$validator->fails()){
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
        } else {

            $returnService = redirect()->back()->withErrors($validator->getMessageBag()->toarray())->withInput();
            return $returnService;
        }
    }
}