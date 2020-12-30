<?php

namespace Qihucms\Qualification\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaStoreRequest extends FormRequest
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
            'real_name' => ['required', 'max:55'],
            'id_card_no' => ['required', 'max:66'],
            'files' => ['sometimes', 'array'],
        ];
    }

    /**
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    public function attributes()
    {
        return trans('qualification_pa');
    }
}
