<?php

namespace Plugin\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollectionRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'nullable|exists:tl_uploaded_files,id',
            'permalink' => 'required|unique:tl_com_product_collections,permalink,' . request()->id,
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => translate('Name is required'),
            'image.exists' => translate('Invalid image'),
            'name.permalink' => translate('Permalink is required'),
            'permalink.unique' => translate('Permalink is already exists'),
        ];
    }
}
