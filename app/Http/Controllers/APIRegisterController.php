<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;

class APIRegisterController extends Controller
{
    public function register(UserRequest $request, User $user)
    {
        $user->fill($request->toArray());
        $user->save();
        $token = JWTAuth::fromUser($user);
        return Response::json(compact('token'));
    }
}