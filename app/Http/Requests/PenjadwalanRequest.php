<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenjadwalanRequest extends FormRequest
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
            'pelajaran_id' => 'required',
            'guru_id' => 'required',
            'kelas_id' => 'required',
            'jam_slot_id' => 'required',
        ];
    }
}
