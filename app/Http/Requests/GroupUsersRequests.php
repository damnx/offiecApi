<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GroupUsersRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       return Auth::user()->can('create');
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
       
        return $rules;
        
    }

}
