<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.08.2018
 * Time: 3:01
 */

namespace App\Transformers\User;
use App\Transformers\Abstracts\Transformer;
use App\User;


class MasterReviewTransformer extends Transformer
{
    public function transform($masterReviews)
    {
        $returnMass = [];
        foreach ($masterReviews as $review){

            $returnMass[] = [
                "value" => $review->value ?: "no rating",
                "comment" => $review->appraisers ? $review->appraisers->comment : "no comments",
                "author" => ($review->appraisers && $review->appraisers->author)
                    ? $review->appraisers->author->fullName
                    : "no author",
            ];

        }
        return $returnMass;
    }
}