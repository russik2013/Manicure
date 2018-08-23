<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

use Validator;
use Log;
use DB;

class UserApiValidation
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return array|\Illuminate\Http\JsonResponse|mixed
     * @throws TokenInvalidException
     */
    public function handle($request, Closure $next)
    {
        $token = $request->token ?: $request->bearerToken();

            /** @var User $user */
            $user = JWTAuth::authenticate($token);
            if ($user || $user instanceof User) {
                return $next($request);
            }

    }
}
