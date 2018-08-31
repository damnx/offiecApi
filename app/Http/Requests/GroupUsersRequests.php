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
        // $id = isset(request()->id) ? request()->id : 'NULL';
        $rules = [
            'name' => 'required|max:100|unique:group_users,name,NULL,id,deleted_at,NULL',
            'status' => 'required',
        ];
        // print_r($rules);
        // die();

        return $rules;

    }

}
