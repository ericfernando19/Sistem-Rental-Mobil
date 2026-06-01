<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:'.(date('Y') + 1),
            'price_per_day' => 'required|numeric|min:0',
            'transmission' => 'required|in:manual,automatic',
            'passenger_capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status' => 'required|in:available,unavailable',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}
