<?php

use App\Transformers\Abstracts\Transformer;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.08.2018
 * Time: 22:16
 */

class ReviewTransformer extends Transformer
{
    public function transform($review)
    {
        dd('russik say stop');
        return [
            "comment" => $review ? $review->comment : "no comment",
            "value" => ($review && $review->getRating) ? $review->getRating->value : "no value",
            "recipient" => ($review && $review->getRating && $review->getRating->recipient)
                ? $review->getRating->recipient->fullName : "no recipient",
        ];
    }
}