<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'          => ['required', 'string', 'max:255', Rule::unique('movies', 'id')],
            'judul'       => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'sinopsis'    => 'required|string',
            'tahun'       => 'required|integer',
            'pemain'      => 'required|string|max:255',
            'foto_sampul' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required'          => 'ID film wajib diisi.',
            'id.unique'            => 'ID film sudah digunakan.',
            'judul.required'       => 'Judul film wajib diisi.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'sinopsis.required'    => 'Sinopsis wajib diisi.',
            'sinopsis.string'      => 'Sinopsis harus berupa teks.',
            'tahun.required'       => 'Tahun rilis wajib diisi.',
            'tahun.integer'        => 'Tahun harus berupa angka.',
            'pemain.required'      => 'Nama pemain wajib diisi.',
            'pemain.string'        => 'Nama pemain harus berupa teks.',
            'pemain.max'           => 'Nama pemain maksimal 255 karakter.',
            'foto_sampul.required' => 'Foto sampul wajib diunggah.',
            'foto_sampul.image'    => 'File harus berupa gambar.',
            'foto_sampul.max'      => 'Ukuran foto maksimal 2MB.',
        ];
    }
}
