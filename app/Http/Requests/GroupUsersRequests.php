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
        $id = isset(request()->id) ? request()->id : null;
        
        $rules = [
            'date' => 'required|max:10|unique:job_calendar,date,' . $id,
            'day' => 'required|max:2',
            'coefficient' => 'required|numeric|min:0|max:3',
            'start' => 'required|date_format:H:i:s',
            'end' => 'required|date_format:H:i:s',
        ];

        $groupUserId = request()->group_user_id;
        if (is_array($groupUserId)) {
            foreach ($groupUserId as $key => $value) {
                $rules['group_user_id.' . $key] = 'required';
            }
        } else {
            $rules['group_user_id'] = 'required|array';
        }
        
        if ($id) {
            $groupUserIdRemove = request()->group_user_id_remove;
            if (is_array($groupUserIdRemove)) {
                foreach ($groupUserIdRemove as $key => $value) {
                    $rules['group_user_id_remove.' . $key] = 'required';
                }
            }

        }

        return $rules;

    }
    //customize messages
    public function messages()
    {
        $messages = [
            'required' => 'The :attribute field is required.',
            'date_format' => 'The :attribute does not match the format time.',
        ];

        return $messages;
    }
}
