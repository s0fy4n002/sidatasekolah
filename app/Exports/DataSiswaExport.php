<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class DataSiswaExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $conditions = ['role_id' => 3,'is_admin' => 0];
        $user_login = Auth::user();
        if($user_login->role_id == 3){
            $conditions['sekolah_id']=$user_login->sekolah_id;
        }
        if($user_login->role_id == 2){
            $conditions['kota_id']=$user_login->kota_id;
        }
        return User::where($conditions)->get();
    }

    public function map($row): array
    {
        static $number = 1;

        return [
            $number++,  // Nomor urut
            $row->name,
            $row->nisn,
            $row->hp,
            $row->gender ==1 ? 'Pria':'Wanita',
            $row->kota?->name,
            $row->sekolah?->name,
            $row->universitas->name??'-',
            $row->fakultas?->value??'-',
            $row->jalur?->name,
            $row->tahun_ajaran?->tahun,
            $row->karir->name??'-',
        ];
    }

    public function title(): string
    {
        return 'Lulusan Berdasarkan Sekolah';
    }

    public function startCell(): string
    {
        return 'A2'; // Data tabel mulai dari sel A2 setelah judul
    }

    public function headings(): array
    {
        return [
            ['Data Lulusan'], // Judul
            [], // Baris kosong sebagai pemisah
            [
                'No',
                'Nama Siswa',
                'NISN',
                'HP',
                'Gender',
                'Kabupaten/Kota',
                'Nama Sekolah',
                'Universitas',
                'Fakultas',
                'Jalur Lulusan',
                'Tahun Ajaran',
                'Status Karir',
            ] // Header tabel
        ];
    }
}
