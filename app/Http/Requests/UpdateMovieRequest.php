<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:35|regex:/[a-zA-Z]/',
            'director' => 'required|string|max:30|regex:/[a-zA-Z]/',
            'genre' => 'required|in:action,drama,comedy,science_fiction',
            'release_year' => 'required|integer|min:1888|max:' . date('Y'),
            'description' => 'required|string|min:10|max:300',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a valid string and cannot consist of only numbers.',
            'title.max' => 'The title may not be greater than 35 characters.',

            'director.required' => 'The director name is required.',
            'director.string' => 'The director name must be a valid string and cannot consist of only numbers.',
            'director.max' => 'The director name may not be greater than 30 characters.',

            'genre.required' => 'The genre is required and must be one of: action, drama, comedy, or science fiction.',
            'genre.in' => 'The selected genre is invalid. Please choose either action, drama, comedy, or science fiction.',

            'release_year.required' => 'The release year is required.',
            'release_year.integer' => 'The release year must be a valid integer.',
            'release_year.min' => 'The release year must be at least 1888 (the year the first known film was made).',
            'release_year.max' => 'The release year cannot be in the future.',

            'description.required' => 'A description of the movie is required.',
            'description.string' => 'The description must be a valid string and cannot consist of only numbers.',
            'description.min' => 'The description must be at least 10 characters long.',
            'description.max' => 'The description may not be greater than 300 characters.',
        ];
    }
}
