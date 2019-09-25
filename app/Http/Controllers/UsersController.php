<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Validators\UserValidator;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    protected $repository;
    protected $validator;

    public function __construct(UserRepository $repository, UserValidator $validator, UserService $service)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service    = $service;
    }


    public function index(){ }

    public function store(UserCreateRequest $request){ }

    /**
     * Return user data to profile page
     */
    public function show($id)
    {
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
    }

    /**
     * Profile Edit Screen
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $returnService = $this->service->update($request->all(), $id);

        return $returnService;
    }

    public function destroy($id){   }
}
