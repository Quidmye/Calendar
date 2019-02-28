<?php

namespace Quidmye\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class EventAddAjaxRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rules = [
            "name" => "required|max:155|min:5",
            "time" => "required|date_format:d.m.Y H:i",
            "color" => "size:7"
            ];

        if($request->has('reminder')){
          $rules['reminder_time'] = "required_if:remember,|date_format:d.m.Y H:i|before:start_time";
        }
        return $rules;
    }
}
