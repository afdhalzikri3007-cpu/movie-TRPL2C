<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul'       => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'sinopsis'    => 'required|string',
            'tahun'       => 'required|integer',
            'pemain'      => 'required|string|max:255',
            'foto_sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required'       => 'Judul film wajib diisi.',
            'judul.string'         => 'Judul film harus berupa teks.',
            'judul.max'            => 'Judul film maksimal 255 karakter.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.integer'  => 'Kategori tidak valid.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'sinopsis.required'    => 'Sinopsis wajib diisi.',
            'sinopsis.string'      => 'Sinopsis harus berupa teks.',
            'tahun.required'       => 'Tahun rilis wajib diisi.',
            'tahun.integer'        => 'Tahun harus berupa angka.',
            'pemain.required'      => 'Nama pemain wajib diisi.',
            'pemain.string'        => 'Nama pemain harus berupa teks.',
            'pemain.max'           => 'Nama pemain maksimal 255 karakter.',
            'foto_sampul.image'    => 'File harus berupa gambar.',
            'foto_sampul.mimes'    => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'foto_sampul.max'      => 'Ukuran foto maksimal 2MB.',
        ];
    }
}
