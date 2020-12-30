<?php

namespace Qihucms\Qualification\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoStoreRequest extends FormRequest
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
            'company_name' => ['required', 'max:255'],
            'company_id' => ['required', 'max:255'],
            'files' => ['sometimes', 'array'],
            'contacts' => ['required', 'required', 'max:255'],
            'mobile' => ['required', 'regex:/^1[3456789]{1}\d{9}$/'],
            'email' => ['sometimes', 'email'],
            'address' => ['sometimes', 'required', 'max:255']
        ];
    }

    /**
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    public function attributes()
    {
        return trans('qualification_co');
    }
}
