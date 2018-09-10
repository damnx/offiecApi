<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class CreateRolesRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (isset(request()->id)) {
            return Gate::allows('UPDATE_ROLES');
        }
        return Gate::allows('CREATE_ROLES');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255|unique:roles,name,NULL,id,deleted_at,NULL',
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
