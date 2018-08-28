<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Requests\RatingRequest;
use App\Http\Requests\ReviewRequest;
use App\Transformers\User\MasterReviewTransformer;
use App\Transformers\User\UserReviewTransformer;
use App\Transformers\User\UserTransformer;
use App\User;
use App\UserReview;
use Illuminate\Http\Request;

use JWTAuth;
use ReviewTransformer;

class UserApiController extends Controller
{

    private $user;

    public function __construct(Request $request)
    {
        $this->middleware('UserApiVal');
        $this->user = JWTAuth::toUser($request->token);
    }

    public function index()
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

        if ($appraiser->count() > 0) {
            $appraiser[0]->value = $request->value;
            $appraiser[0]->save();

        } else {
            $this->user->getRating()->create(["user_id" => $request->master_id, "value" => $request->value]);
        }

        return "add or update rating of master";
    }

    public function allReviews()
    {
        // вывод всех комментариев оставленных пользователем это для пользователя
        if ($this->user->role->roleInfo->name == 'client')
            return (new UserReviewTransformer())->transform($this->user
                ->with('getReview', 'getReview.getRating', 'getReview.getRating.recipient')
                ->find($this->user->id)->getReview);

        //вывод всех комментариев, для мастера
        if ($this->user->role->roleInfo->name == 'master')
            return (new MasterReviewTransformer())
                ->transform($this->user->with('userReviews', 'userReviews.appraisers', "userReviews.appraisers.author")
                    ->find($this->user->id)->userReviews);

    }

    public function allReviewOneUser(RatingRequest $request)
    {
        $review = $this->user
            ->with('getReview', 'getReview.getRating', 'getReview.getRating.recipient')
            ->find($this->user->id)->getReview->filter(function ($item, $key) use ($request) {
                if (($item->getRating ? $item->getRating->user_id : 0) == $request->master_id) {
                    return $item;
                }
            });

        return (new UserReviewTransformer())->transform($review);
    }

    public function reviewStore(ReviewRequest $request)
    {
       ($this->user->getReview()->create(["comment" => $request->comment]))
            ->getRating()->create(["user_id" => $request->master_id, "value" => $request->value]);

       return "review was added";
    }

    public function reviewEdit($id = null)
    {
        $review = UserReview::with('getRating', 'getRating.recipient')->find($id);
        if(($review ? $review->client_id : 0) == $this->user->id)
            return (new ReviewTransformer())->transform($review);
        else return "it is no your comment";
    }

    /**
     * @param ReviewRequest $request
     * @return array|string
     */
    public function reviewUpdate(ReviewRequest $request)
    {
        $review = UserReview::find($request->review_id);
        if(($review ? $review->client_id : 0) == $this->user->id) {
            $review->fill($request->all())->getRating()
                ->update(["value" => $request->value, "user_id" => $request->master_id]);
            $review->save();
            return "review was updated";
        }
        else return "it is no your comment";
    }

    public function reviewDelete(Request $request)
    {
        $review = UserReview::find($request->review_id);
        if(($review ? $review->client_id : 0) == $this->user->id) {
            $review->getRating()->delete();
            $review->delete();
            return "review was deleted";
        }
        else return "it is no your comment";
    }
}
