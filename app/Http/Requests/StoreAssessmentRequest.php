<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'answers' => 'required|array|size:21',
            'answers.*' => 'required|integer|min:0|max:3',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $answers = $this->input('answers');
            // Optional: Check that all 21 are between 0-3 (already covered)
        });
    }

    public function messages(): array
    {
        return [
            'answers.size' => 'You must answer all 21 questions to get an accurate result.',
            'answers.*.required' => 'Please select an option for every question.',
        ];
    }
}
