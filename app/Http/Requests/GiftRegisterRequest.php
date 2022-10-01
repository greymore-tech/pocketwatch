<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GiftRegisterRequest extends FormRequest
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
           	'first_name' => ['required', 'string'],
						'last_name' => ['nullable','string'],
						'phone' => ['required', 'numeric', 'min:100000000'],
						'email' => ['nullable', 'email'],
						'id' => ['required', 'numeric'],
						'category' => ['required', 'string', 'not_in:0'],
		      	'product' => ['nullable', 'string', 'not_in:0'],
		      	'division' => ['required', 'string', 'not_in:0'],
		      	'itemcode' => ['nullable', 'string'],
		      	'amount' => ['nullable', 'numeric']
        ];
    }
}
