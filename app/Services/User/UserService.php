<?php

namespace App\Services\User;

use App\Helpers\HttpStatus;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Services\Service;
use App\Repositories\User\UserRepository;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService extends Service
{
    use ResponseTrait;

    /**
     * @return string
     */
    public function repository()
    {
        return UserRepository::class;
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->repository->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;


        return $this->response(['access_token' => $token], true , 'User Register Successfully', HttpStatus::HTTP_OK);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->response([],false,'Invalid Login details', HttpStatus::HTTP_UNAUTHORIZED);
        }

        $user = $this->repository->where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->response(['access_token' => $token], true , 'User Login Successfully', HttpStatus::HTTP_OK);
    }
}
