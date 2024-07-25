<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function index(Request $request){
        $conditions = ['role_id' => 2,'is_admin' => 1];
        $user_login = Auth::user();
        $title="Daftar Admin Kota";
  
        $users = User::where($conditions)->orderBy("created_at","desc")->get();
        return view('super-admin.index', compact('users','title'));
      } 

      public function createAdminKota()
      {
            $cities = Kota::all();
           $title = 'Admin Kota / Kabupaten';
           return view('super-admin.createAdminKota', compact('cities'));
      }

      public function storeAdminKota(Request $request)
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
           $user->hp = $request->hp;
           $user->gender = $request->gender;
           $user->kota_id = $request->kota_id;
           $user->is_admin = 1;
 
 
           try {
                $user->save();
                return redirect()->route('super-admin.index')
                     ->with('success', 'Berhasil Menambahkan admin kota / kabupaten Baru');
           } catch (Exception $e) {
                dd($e->getMessage());
           }
      }
 

      public function showAdminKota($id)
      {
            $user = User::where(['id' =>$id])->first();
            return view('super-admin.show', compact('user'));
      }

      public function editAdminKota($id){
            $user = User::where(['id' => $id])->first();
            $cities = Kota::all();
            $title = 'Admin Kota / Kabupaten';
  
            return view('super-admin.edit', compact('user', 'cities', 'title'));
      }
 
      public function updateAdminKota(Request $request, $id)
      {
           $request->validate([
                'username' => 'required|string|max:255',
                'kota_id' => 'required',
                'gender' => 'required|string|in:1,2',
           ]);
           $user = User::where(['id' => $id])->with(["sekolah"])->first();
           $user->name = $request['username'];
           $user->update($request->all());
           return redirect()->route('super-admin.index')->with('success', 'berhasil diperbarui.');
      }

      public function listSekolah($kota_id){
          $conditions = ['users.role_id' => 3,'is_admin' => 0];
      
          $conditions['users.kota_id']=$kota_id;

          $results = DB::table('users')
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
          return view('admin-sekolah.generate',compact('results'));
      }
}
