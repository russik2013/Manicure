<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15.08.2018
 * Time: 3:30
 */

namespace App\Transformers\User;
use App\Transformers\Abstracts\Transformer;
use App\User;


class UserTransformer extends Transformer
{
    public function transform(User $user)
    {
        return [
            'name' => "{$user->name}",
            'email' => $user->email,
            'verificationCode' => $user->verificationCode,
            'city' => $user->city,
            'firstName' => $user->firstName,
            'lastName' => $user->lastName,
            'age' => $user->age,
            'role' => ($user->role && $user->role->roleInfo )? $user->role->roleInfo->name : 'default',
            'rating' => $user->avgRating,
        ];
    }
}