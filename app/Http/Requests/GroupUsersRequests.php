<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupUsersRequests extends FormRequest
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
        $rules = [
            //
            'name' => 'required|max:100|unique:group_users',
            'status' => 'required',
        ];

        return $rules;
    }
    //customize messages
    // public function messages()
    // {
    //     $messages =[
    //         'name.required'=>'không đợc để chống name'
    //     ];

    //     return $messages;
    // }
}
