<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.08.2018
 * Time: 3:45
 */

namespace App\Transformers\User;
use App\Transformers\Abstracts\Transformer;
use App\User;


class UserReviewTransformer extends Transformer
{
    public function transform($userReviews)
    {
        $returnMass = [];
        foreach ($userReviews as $review){

            $returnMass[] = [
                "value" => $review->getRating ? $review->getRating->value : "no rating",
                "comment" => $review->comment ?: "no comments",
                "recipient" => ($review->getRating && $review->getRating->recipient)
                    ? $review->getRating->recipient->fullName
                    : "no author",
            ];

        }
        return $returnMass;
    }
}