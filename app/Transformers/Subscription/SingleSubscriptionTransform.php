<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 30.08.2018
 * Time: 13:18
 */

use App\Transformers\Abstracts\Transformer;

class SingleSubscriptionTransform extends Transformer
{
    public function transform($subscription)
    {
        return [
                "не забудь сделать это"
        ];
    }
}