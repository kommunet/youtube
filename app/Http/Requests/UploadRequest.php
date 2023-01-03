<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
			'title'       => 'required|string|max:100',
			'tags'        => 'required|string|max:75',
            'video'       => 'required|mimetypes:video/avi,video/mpeg,video/quicktime,video/x-ms-asf,video/mp4,video/x-flv',
			'description' => 'string|max:2500',
        ];
    }
}
