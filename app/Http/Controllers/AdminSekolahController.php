<?php

namespace App\Http\Controllers;

use App\Exports\DataSiswaExport;
use App\Exports\LulusanExport;
use App\Models\Fakultas;
use App\Models\Jalur;
use App\Models\Karir;
use App\Models\Kota;
use App\Models\Sekolah;
use App\Models\Tahun;
use App\Models\Universitas;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AdminSekolahController extends Controller
{
   public function index(Request $request){
     $conditions = ['role_id' => 3,'is_admin' => 1];
     $user_login = Auth::user();
     $title="Admin Sekolah";
     
     if($user_login->role_id == 2){
          //admin kota
        $title="Admin Sekolah {$user_login->kota->name}";
        $conditions['users.kota_id']=$user_login->kota_id;
     }

     if($user_login->role_id == 1){
      
     }
     $users = User::where($conditions)->orderBy("created_at","desc")->get();
  
     return view('admin-sekolah.index', compact('users','title'));
   } 

   public function create(){
     $kota_where=[];
     $sekolah_where=[];
     $user_login = Auth::user();
     if($user_login->role_id == 3){
          //admin sekolah
          $kota_where['id']= $user_login->kota_id;
          $sekolah_where['id']=$user_login->sekolah_id;
     }
     
     if($user_login->role_id == 2){
          //admin kota
          $kota_where['id']= $user_login->kota_id;
          $sekolah_where['kota_id']=$user_login->kota_id;
     }


     $cities = Kota::where($kota_where)->get();
     $schools = Sekolah::where($sekolah_where)->get();

     $tahun_ajaran = Tahun::all();
     $universitas = Universitas::all();
     $faculties = Fakultas::all();
     $karir = Karir::all();
     $title = 'Tambah Admin Sekolah';
     return view('admin-sekolah.create', compact('title','cities','schools','faculties','tahun_ajaran','karir','universitas'));
   }

   public function store(Request $request)
   {      

     $request->validate([
          'username' => 'required|string|max:255',
          'kota_id' => 'required',
          'sekolah_id' => 'required',
          'gender' => 'required|string|in:1,2',
      ]);
     $user = new User();
     $user->username = $request->username;
     $user->name = $request->username;
     $user->gender = $request->gender;
     $user->hp = $request->hp;
     $user->kota_id = $request->kota_id;
     $user->sekolah_id = $request->sekolah_id;
     
     $user->password = Hash::make(123);
     $user->role_id = 3;
     $user->is_admin =1;

     try {
          $user->save();  
          return redirect()->route('admin-sekolah.index')
          ->with('success', 'Berhasil Menambahkan Admin Sekolah Baru');
     } catch (Exception $e) {
          dd($e->getMessage());
     }
   }


   public function edit($id)
   {
     $user_login = Auth::user();
     if($user_login->role_id == 2 || $user_login->role_id == 3 ){
          $cities = Kota::where(['id' => $user_login->kota_id])->get();
          $schools = Sekolah::where(['kota_id' => $user_login->kota_id])->get();
     }
     else{
          $cities = Kota::all();
          $schools = Sekolah::all();
     }
     $tahun_ajaran  =Tahun::all();
     $universitas  =Universitas::all();
     $karir  =Karir::all();
     $jalur  =Jalur::all();
     $user = User::where(['id' =>$id])->first();
     $faculties = Fakultas::all();

     $title = 'Admin Sekolah';
  
       return view('admin-sekolah.edit', compact('user','cities','title','schools','faculties','tahun_ajaran','karir','universitas','jalur'));
   }
   public function show($id)
   {
          $user = User::where(['id' =>$id])->first();
          return view('admin-sekolah.show', compact('user'));
   }

   public function update(Request $request, $id)
    {
          $request->validate([
               'username' => 'required|string|max:255',
               'kota_id' => 'required',
               'sekolah_id' => 'required',
               'gender' => 'required|string|in:1,2',
          ]);
        
          $user = User::where(['id' =>$id])->first();
          $user->update($request->all());
          return redirect()->route('admin-sekolah.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::where(['id' =>$id])->first();
        $user->delete();
        return redirect()->route('admin-sekolah.index')->with('success', 'user berhasil dihapus.');
    }

    public function fakultas(){
          return view('admin-sekolah.fakultas');
    }

    public function savefakultas(Request $request)
    {
        // Validasi input jika perlu
        $data = $request->input('fakultas');
        return response()->json(['data' => $data]);

        // Insert data ke database
        foreach ($data as $item) {
            Fakultas::create([
                'value' => $item['value'],
                'data' => $item['data']
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    public function ubahPassword(){
          return view('admin-sekolah.password');
    }
    
    public function prosesUbahPassword(Request $request){
          $request->validate(['password' => 'required']);
          $user = User::where(['id' => Auth::user()->id])->first();
          $user->password = Hash::make($request->password);
          $user->save();
          return redirect()->back()->with('success','berhasil Update password');
    }

    public function generate(){
     $conditions = ['role_id' => 3,'is_admin' => 0];
     $user_login = Auth::user();
     if($user_login->role_id == 3){
         $conditions['sekolah_id']=$user_login->sekolah_id;
     }
     if($user_login->role_id == 2){
         $conditions['kota_id']=$user_login->kota_id;
     }

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

    public function export()
    {
        return Excel::download(new LulusanExport, 'lulusan-sekolah.xlsx');
    }

    public function generateDataSiswa(){
     $conditions = ['role_id' => 3];
     $conditions = ['is_admin' => 0];
     $user_login = Auth::user();
     if($user_login->role_id == 3){
         $conditions['sekolah_id']=$user_login->sekolah_id;
     }
     if($user_login->role_id == 2){
         $conditions['kota_id']=$user_login->kota_id;
     }

     $results = User::where($conditions)->get();
     return view('admin-sekolah.data_siswa',compact('results'));
    }

    public function exportDataSiswa()
    {
        return Excel::download(new DataSiswaExport, 'data-siswa.xlsx');
    }

    public function resetPassword($id){
     $default_password =123;
     $user = User::where(['id' => $id])->first();
     $user->password = Hash::make($default_password);
     $user->save();
     return redirect()->back()->with('success','Berhasil reset password');
    }


}
