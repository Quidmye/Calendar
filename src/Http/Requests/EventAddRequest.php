<?php

namespace Quidmye\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventAddRequest extends FormRequest
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
            "name" => "required|max:155|min:5",
            "start_time" => "required|date_format:d.m.Y H:i",
            "end_time" => "required|date_format:d.m.Y H:i|after_or_equal:start_time",
            "reminder_time" => "required_if:remember,|date_format:d.m.Y H:i|before:start_time",
            "description" => "max:500",
            "event_files" =>  "nullable|mimetypes:audio/mpeg,audio/ogg,audio/webm,image/gifimage/jpeg,image/pjpeg,image/png"
        ];
    }
}
