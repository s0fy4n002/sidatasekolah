<?php

namespace App\Http\Controllers;

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

class SiswaController extends Controller
{
    public function index(Request $request){
        $conditions = ['role_id' => 3, 'is_admin' => 0];
        $user_login = Auth::user();
     
        $title="Semua Siswa";
        
        if($user_login->role_id ==2){
             //admin kota
             $conditions['kota_id'] = $user_login->kota_id;
        }
   
        if($user_login->role_id == 3){
             //admin sekolah
             $conditions['sekolah_id']= $user_login->sekolah_id;
               $title = "Siswa {$user_login->sekolah->name} Kota {$user_login->kota->name}";
   
        }
        if($request->sekolah_id){
          $conditions['sekolah_id'] = $request['sekolah_id'];
        }
        if($request->sekolah_id){
          $conditions['users.sekolah_id']= $request->sekolah_id;
      }
   
        $users = User::where($conditions)->orderBy("created_at","desc")->get();
        return view('siswa.index', compact('users','title'));
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
          $tahun_ajaran = Tahun::orderBy('id','desc')->get();
          $universitas = Universitas::all();
          $faculties = Fakultas::all();
          $jalur = Jalur::all();
          $karir = Karir::all();
          $title = 'Tambah Siswa';
          return view('siswa.create', compact('title','cities','schools','faculties','tahun_ajaran','karir','universitas','jalur'));
        }

     public function store(Request $request)
     {      
          $request->validate([
               'nisn' => 'required|unique:users|max:255',
               'username' => 'required|string|max:255',
               'gender' => 'required|string|in:1,2',
               'kota_id' => 'required',
               'status_study' => 'required',
               'sekolah_id' => 'required',
               'jalur_id' => 'required',
          ]);
          $user = User::create($request->all());
          if(!$user){
               return redirect()->back()->withInput();
          }
          return redirect()->route('siswa.index')->with('success', 'Berhasil Menambahkan Siswa Baru');

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
     $tahun_ajaran = Tahun::orderBy('id','desc')->get();
     $universitas  =Universitas::all();
     $karir  =Karir::all();
     $jalur  =Jalur::all();
     $user = User::where(['id' =>$id])->first();
     $faculties = Fakultas::all();
     $title = 'Siswa';
  
       return view('siswa.edit', compact('user','cities','title','schools','faculties','tahun_ajaran','karir','universitas','jalur'));
   }
   public function show($id)
   {
          $user = User::where(['id' =>$id])->first();
          return view('siswa.show', compact('user'));
   }

   public function update(Request $request, $id)
    {
          $request->validate([
               'status_study' => 'required',
               'username' => 'required|string|max:255',
               'kota_id' => 'required',
               'sekolah_id' => 'required',
               'gender' => 'required|string|in:1,2',
          ]);
          if(empty($request->karir_id)){
               $request['karir_id'] = null;
          }
          if(empty($request->universitas_id)){
               $request['universitas_id'] = null;
          }
          if(empty($request->fakultas_id)){
               $request['fakultas_id'] = null;
          }
          $user = User::where(['id' =>$id])->first();
          $user->update($request->all());
          return redirect()->back()->with('success', 'Berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::where(['id' =>$id])->first();
        $user->delete();
        return redirect()->back()->with('success', 'user berhasil dihapus.');
    }

   
}
