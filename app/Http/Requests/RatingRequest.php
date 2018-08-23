<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "master_id" => 'required|exists:user_roles,user_id,role_id,2'
        ];
    }

    public function messages()
    {
        return [

            "master_id.exists" => "selected user must be master"

        ];
    }
}
