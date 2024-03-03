<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class UpdateProjectRequest extends FormRequest
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
            'title' => 'required|max:200',
            'description' => 'required',
            'preview_image' => 'required',
            'authors' => 'required|max:200',
            'completed' => 'required',
        ];
    }

    public function messages(){
        return [
            'title.required' => 'Title section must be filled!',
            'title.max' => 'Title must be under 200 characters!',            'description.required' => 'Description section must be filled!',
            'preview_image.required' => 'Preview Image section must be filled!',
            'authors.required' => 'Authors section must be filled!',
            'authors.max' => 'Authors must be under 200 characters!',
            'completed.required' => 'Completed section must be filled!',
        ];
    }
}
