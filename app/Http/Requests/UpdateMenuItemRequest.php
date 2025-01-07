<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuItemRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:25',
            'description' => 'sometimes|required|string|max:100',
            'category_id' => 'sometimes|required|exists:categories,id',
            'price' => 'sometimes|required|integer|min:1|max:100000',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'composition' => 'sometimes|required|array|min:1',
            'composition.*' => 'exists:ingredients,id',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'A név megadása kötelező.',
            'name.string' => 'A név csak szöveget tartalmazhat.',
            'name.max' => 'A név nem lehet hosszabb, mint 25 karakter.',
            'description.required' => 'A leírás megadása kötelező.',
            'description.string' => 'A leírás csak szöveget tartalmazhat.',
            'description.max' => 'A leírás nem lehet hosszabb, mint 100 karakter.',
            'category_id.required' => 'A kategória megadása kötelező.',
            'category_id.exists' => 'A megadott kategória nem létezik.',
            'price.required' => 'Az ár megadása kötelező.',
            'price.integer' => 'Az ár csak egész szám lehet.',
            'price.min' => 'Az árnak legalább 1-nek kell lennie.',
            'price.max' => 'Az ár nem lehet nagyobb 100.000-nél.',
            'image.required' => 'A kép megadása kötelező.',
            'image.image' => 'A kép formátuma érvénytelen.',
            'image.mimes' => 'A kép csak jpeg, png, jpg vagy gif formátumú lehet.',
            'image.max' => 'A kép mérete nem lehet nagyobb, mint 2048 kilobájt.',
            'composition.required' => 'Legalább egy összetevőt ki kell választani.',
            'composition.array' => 'Az összetevők formátuma érvénytelen.',
            'composition.min' => 'Legalább egy összetevőt ki kell választani.',
            'composition.*.exists' => 'A megadott összetevő nem létezik.',
        ];
    }
}
