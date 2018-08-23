<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Requests\RatingRequest;
use App\Transformers\User\MasterReviewTransformer;
use App\Transformers\User\UserReviewTransformer;
use App\Transformers\User\UserTransformer;
use App\User;
use Illuminate\Http\Request;

use JWTAuth;

class UserApiController extends Controller
{

    private $user;

    public function __construct(Request $request)
    {
        $this->middleware('UserApiVal' );
        $this->user = JWTAuth::toUser($request->token);
    }

    public function index(Request $request)
    {
        return (new UserTransformer())->transform($this->user);
    }

    public function areas()
    {
        return Area::all();
    }

    public function setRating(RatingRequest $request)
    {
       $appraiser = ($this->user)->getRating->filter(function ($item, $key) use ($request) {
            if ($item->user_id == $request->master_id) {
                return $item;
            }
        });

       if($appraiser->count() > 0){
           $appraiser[0]->value = $request->value;
           $appraiser[0]->save();

       } else {
            $this->user->getRating()->create(["user_id" => $request->master_id, "value" => $request->value]);
       }

       return "add or update rating of master";
    }

    public function allReviews()
    {
        // работает вывод всех комментариев оставленных пользователем это для пользователя
        if($this->user->role->roleInfo->name == 'client')
            return (new UserReviewTransformer())->transform($this->user
                ->with('getReview', 'getReview.getRating', 'getReview.getRating.recipient')
                ->find($this->user->id)->getReview);

        //вывод всех комментариев, для мастера
        if($this->user->role->roleInfo->name == 'master')
            return (new MasterReviewTransformer())
                ->transform($this->user->with('userReviews', 'userReviews.appraisers',"userReviews.appraisers.author")
                    ->find($this->user->id)->userReviews);

    }
}
