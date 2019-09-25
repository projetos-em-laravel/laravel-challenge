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
                'message' => 'User updated.',
                'data'    => $user->toArray(),
            ];
            /*
            if ($data->wantsJson()) {

                return response()->json($response);
            }
            */
            $returnService = redirect()->back()->with('message', $response['message']);
            return $returnService;
        } catch (ValidatorException $e) {

            /*
            if ($data->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            */
            $returnService = redirect()->back()->withErrors($e->getMessageBag())->withInput();
            return $returnService;
        }
    }
}