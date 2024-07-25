<?php

namespace App\Http\Controllers;

use App\Exports\LulusanKotaExport;
use App\Models\Kota;
use App\Models\Sekolah;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AdminKotaController extends Controller
{
     public function index()
     {
          if (Auth::user()->role_id == 3) {
               return redirect('/');
          }

          $conditions = ['role_id' => 3, 'is_admin' => 0];

          $auth = Auth::user();
          $title = '';
          if($auth->role_id == 1){
               $title = "Daftar Semua Sekolah";
          }
          if($auth->role_id == 2){
               $title = "Daftar Sekolah di Kota {$auth->kota->name}";
               $conditions['users.kota_id']=$auth->kota_id;
          }     

          $results = DB::table('users')
          ->where($conditions)
          ->join('jalur', 'users.jalur_id', '=', 'jalur.id')
          ->join('sekolah', 'users.sekolah_id', '=', 'sekolah.id')
          ->select(
               'sekolah.id as id',
               'sekolah.name as nama_sekolah',
               DB::raw('SUM(CASE WHEN jalur.name = "SNBP" THEN 1 ELSE 0 END) as jumlah_lulusan_snbp'),
               DB::raw('SUM(CASE WHEN jalur.name = "SNBT" THEN 1 ELSE 0 END) as jumlah_lulusan_snbt'),
               DB::raw('SUM(CASE WHEN jalur.name = "SPAN SPTKIN" THEN 1 ELSE 0 END) as jumlah_lulusan_span_sptkin'),
               DB::raw('SUM(CASE WHEN jalur.name = "Perguruan Swasta" THEN 1 ELSE 0 END) as jumlah_lulusan_perguruan_swasta'),
               DB::raw('SUM(CASE WHEN jalur.name = "Kedinasan" THEN 1 ELSE 0 END) as jumlah_lulusan_kedinasan'),
               DB::raw('COUNT(*) as jumlah_total')
          )
          ->groupBy(['sekolah.name','sekolah.id'])
          ->orderBy('sekolah.name')
          ->get();
          return view('admin-kota.index', compact('results', 'title'));
     }

     public function create()
     {
          $cities = Kota::all();
          $title = 'Admin Kota / Kabupaten';
          return view('admin-kota.create', compact('cities'));
     }

     public function store(Request $request)
     {

          $request->validate([
               'username' => 'required|string|max:255',
               'password' => 'required',
               'kota_id' => 'required',
               'gender' => 'required|string|in:1,2',
          ]);
          $user = new User();
          $user->username = $request->username;
          $user->name = $request->username;
          $user->password = Hash::make($request->password);
          $user->role_id = 2;
          $user->gender = $request->gender;
          $user->kota_id = $request->kota_id;


          try {
               $user->save();
               return redirect()->route('admin-kota.index')
                    ->with('success', 'Berhasil Menambahkan admin kota / kabupaten Baru');
          } catch (Exception $e) {
               dd($e->getMessage());
          }
     }


     public function edit($id)
     {
          $user = User::where(['id' => $id])->first();
          $cities = Kota::all();
          $title = 'Admin Kota / Kabupaten';

          return view('admin-kota.edit', compact('user', 'cities', 'title'));
     }

     public function update(Request $request, $id)
     {
          $request->validate([
               'username' => 'required|string|max:255',
               'kota_id' => 'required',
               'gender' => 'required|string|in:1,2',
          ]);
          $user = User::where(['id' => $id])->with(["sekolah"])->first();
          $user->name = $request['username'];
          $user->update($request->all());
          return redirect()->route('admin-kota.index')->with('success', 'berhasil diperbarui.');
     }

     public function destroy($id)
     {
          $user = User::where(['id' => $id])->first();
          $user->delete();
          return redirect()->route('admin-kota.index')->with('success', 'berhasil dihapus.');
     }

     public function showSekolahByIdSekolah($id_sekolah)
     {
          $conditions = ['role_id' => 3, 'is_admin' => 0];
          $conditions['sekolah_id'] = $id_sekolah;
  
          $sekolah = Sekolah::where(['id' => $id_sekolah])->first();
          $title = "Siswa {$sekolah->name}";

          $users = User::where($conditions)->orderBy("created_at", "desc")->get();
          return view('admin-sekolah.index', compact('users', 'title'));
     }

     public function generate()
     {
          $results = DB::table('users')
               ->join('jalur', 'users.jalur_id', '=', 'jalur.id')
               ->join('kota', 'users.kota_id', '=', 'kota.id')
               ->select(
                    'kota.name as nama_kota',
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
          return view('admin-kota.generate', compact('results'));
     }

     public function export()
     {
          return Excel::download(new LulusanKotaExport, 'lulusan-kota.xlsx');
     }

     public function saveAdminSekolah(Request $request){
          $request->validate([
               'username' => 'required|string|max:255',
               'kota_id' => 'required',
               'sekolah_id' => 'required',
               'gender' => 'required|string|in:1,2',
           ]);
          $user = new User();
          $user->username = $request->username;
          $user->name = $request->username;
          $user->password = Hash::make(123);
        
          $user->role_id = 2;
          $user->gender = $request->gender;
          $user->kota_id = $request->kota_id;
          $user->sekolah_id = $request->sekolah_id;
          $user->fakultas_id = $request->fakultas_id;
     
          try {
               $user->save();  
               return redirect()->route('admin-sekolah.index')
               ->with('success', 'Berhasil Menambahkan Admin Sekolah Baru');
          } catch (Exception $e) {
               dd($e->getMessage());
          }
     }
}
