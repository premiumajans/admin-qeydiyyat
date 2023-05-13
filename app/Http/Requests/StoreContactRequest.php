<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'name' => 'required|min:2|max:255|string',
            'email' => 'required|email|string',
            'phone' => 'required|max:255|string',
            'subject' => 'required|max:255|string',
            'message' => 'required|string',
        ];
    }

    /* public function messages()
    {
        return [
            'name.required' => __('Ad xanası boş buraxıla bilməz.'),
            'name.min' => __('Ad 2 hərfdən az ola bilməz.'),
            'name.max' => __('Ad maximum 255 simvol ola bilər.'),
            'name.string' => __('Ad yazı formatında olmalıdır'),
        ];
    } */
}
