<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class TaskCreateOrUpdateRequests extends FormRequest
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
        return Gate::allows('CREATE_TASK');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = isset(request()->id) ? request()->id : 'NULL';

        $rules = [
            'name' => 'required|max:255|unique:tasks,name,NULL,' . $id . ',deleted_at,NULL',
            'link' => 'max:255',
            'status' => 'required|integer',
            'time_comitted' => 'required|integer',
            'time_start' => 'required|date_format:Y-m-d H:i:s',
            'time_end' => 'required|date_format:Y-m-d H:i:s',
        ];

        return $rules;
    }
}
