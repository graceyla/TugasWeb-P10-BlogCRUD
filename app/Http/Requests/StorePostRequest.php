<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:150'],
            'category' => ['required', Rule::in(Post::KATEGORI)],
            'content' => ['required', 'string', 'min:20'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'min' => ':attribute minimal :min karakter.',
            'max.string' => ':attribute maksimal :max karakter.',
            'max.file' => ':attribute maksimal 2 MB.',
            'in' => ':attribute yang dipilih tidak valid.',
            'image' => ':attribute harus berupa gambar.',
            'mimes' => ':attribute harus berformat jpg, jpeg, png, atau webp.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Judul',
            'category' => 'Kategori',
            'content' => 'Isi post',
            'image' => 'Gambar',
        ];
    }
}
