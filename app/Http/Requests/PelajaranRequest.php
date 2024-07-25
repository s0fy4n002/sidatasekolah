<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelajaranRequest extends FormRequest
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
            'id_pelajaran' => 'required|unique:pelajaran,id_pelajaran',
            'name' => 'required|unique:pelajaran,name',
            'tahun_ajaran' => 'required',
            
        ];
    }
}
