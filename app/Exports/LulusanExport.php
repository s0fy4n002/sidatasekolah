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

class LulusanExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $conditions=[];
        $auth = Auth::user();
        if($auth->role_id == 3){
            $conditions['users.sekolah_id']=$auth->sekolah_id;
        }

        if($auth->role_id == 2){
            $conditions['users.kota_id'] = $auth->kota_id;
        }

        return DB::table('users')
            ->where(['users.is_admin' => 0,'users.role_id' => 3])
            ->where($conditions)
            ->join('jalur', 'users.jalur_id', '=', 'jalur.id')
            ->join('sekolah', 'users.sekolah_id', '=', 'sekolah.id')
            ->select('sekolah.name as nama_sekolah',
                DB::raw('SUM(CASE WHEN jalur.name = "SNBP" THEN 1 ELSE 0 END) as jumlah_lulusan_snbp'),
                DB::raw('SUM(CASE WHEN jalur.name = "SNBT" THEN 1 ELSE 0 END) as jumlah_lulusan_snbt'),
                DB::raw('SUM(CASE WHEN jalur.name = "SPAN SPTKIN" THEN 1 ELSE 0 END) as jumlah_lulusan_span_sptkin'),
                DB::raw('SUM(CASE WHEN jalur.name = "Perguruan Swasta" THEN 1 ELSE 0 END) as jumlah_lulusan_perguruan_swasta'),
                DB::raw('SUM(CASE WHEN jalur.name = "Kedinasan" THEN 1 ELSE 0 END) as jumlah_lulusan_kedinasan'),
                DB::raw('COUNT(*) as jumlah_total')
            )
            ->groupBy('sekolah.name')
            ->orderBy('sekolah.name')
            ->get();
    }

    public function map($row): array
    {
        static $number = 1;

        return [
            $number++,  // Nomor urut
            $row->nama_sekolah,
            $row->jumlah_lulusan_snbp,
            $row->jumlah_lulusan_snbt,
            $row->jumlah_lulusan_span_sptkin,
            $row->jumlah_lulusan_perguruan_swasta,
            $row->jumlah_lulusan_kedinasan,
            $row->jumlah_total,
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
            ['Data Lulusan Berdasarkan Sekolah'], // Judul
            [], // Baris kosong sebagai pemisah
            [
                'No',
                'Nama Sekolah',
                'Jumlah Lulusan SNBP',
                'Jumlah Lulusan SNBT',
                'Jumlah Lulusan SPAN SPTKIN',
                'Jumlah Lulusan Ke Perguruan Swasta',
                'Jumlah Lulusan Kedinasan',
                'Jumlah'
            ] // Header tabel
        ];
    }
}
