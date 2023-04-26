<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules['name'] = 'required';
        $rules['answer0'] = 'required';


        for ($i = 1; $i <= 10; $i++)
        {
            if ($this->has('answer' . $i))
            {
                $rules['answer' . $i] = 'required';
            }
            else
            {
                break;
            }
        }

        return $rules;
    }
}
