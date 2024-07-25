<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class LulusanKotaExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithCustomStartCell
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')
            ->join('jalur', 'users.lulusan_id', '=', 'jalur.id')
            ->join('kota', 'users.kota_id', '=', 'kota.id')
            ->select('kota.name as nama_kota',
                DB::raw('SUM(CASE WHEN jalur.name = "SNBP" THEN 1 ELSE 0 END) as jumlah_lulusan_snbp'),
                DB::raw('SUM(CASE WHEN jalur.name = "SNBT" THEN 1 ELSE 0 END) as jumlah_lulusan_snbt'),
                DB::raw('SUM(CASE WHEN jalur.name = "SPAN SPTKIN" THEN 1 ELSE 0 END) as jumlah_lulusan_span_sptkin'),
                DB::raw('SUM(CASE WHEN jalur.name = "Perguruan Swasta" THEN 1 ELSE 0 END) as jumlah_lulusan_perguruan_swasta'),
                DB::raw('SUM(CASE WHEN jalur.name = "Kedinasan" THEN 1 ELSE 0 END) as jumlah_lulusan_kedinasan'),
                DB::raw('COUNT(*) as jumlah_total')
            )
            ->groupBy('kota.name')
            ->orderBy('kota.name')
            ->get();
    }

    public function map($row): array
    {
        static $number = 1;

        return [
            $number++,  // Nomor urut
            $row->nama_kota,
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
        return 'Lulusan Berdasarkan Kota / Kabupaten';
    }

    public function startCell(): string
    {
        return 'A2'; // Data tabel mulai dari sel A2 setelah judul
    }

    public function headings(): array
    {
        return [
            ['Data Lulusan Berdasarkan Kota/Kabupaten'], // Judul
            [], // Baris kosong sebagai pemisah
            [
                'No',
                'Nama Kota',
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
