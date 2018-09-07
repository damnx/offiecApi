<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateRolesRequests extends FormRequest
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
            'name' => 'required|max:255|unique:roles',
        ];

        $groupUserId = request()->group_user_id;
        if (is_array($groupUserId)) {
            foreach ($groupUserId as $key => $value) {
                $rules['userId.' . $key] = 'required|max:36';
            }
        } else {
            $rules['userId'] = 'required|array';
        }

        return $rules;
    }
}
