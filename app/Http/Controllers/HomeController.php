<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index(){
        $conditions=['role_id' => 3,'is_admin' => 0];
        $total_sekolah=0;
        $user_login = Auth::user();
        if($user_login->role_id==3){
            $conditions['sekolah_id'] = $user_login->sekolah_id;
            $results=[];
        }
        
        if($user_login->role_id==2){
            $conditions['users.kota_id'] = $user_login->kota_id;

            $results = DB::table('users')
                           ->where($conditions)
                           ->join('jalur', 'users.jalur_id', '=', 'jalur.id')
                           ->join('sekolah', 'users.sekolah_id', '=', 'sekolah.id')
                           ->select(
                                'sekolah.id as sekolah_id',
                                'sekolah.name as nama_sekolah',
                                DB::raw('SUM(CASE WHEN jalur.name = "SNBP" THEN 1 ELSE 0 END) as jumlah_lulusan_snbp'),
                                DB::raw('SUM(CASE WHEN jalur.name = "SNBT" THEN 1 ELSE 0 END) as jumlah_lulusan_snbt'),
                                DB::raw('SUM(CASE WHEN jalur.name = "SPAN SPTKIN" THEN 1 ELSE 0 END) as jumlah_lulusan_span_sptkin'),
                                DB::raw('SUM(CASE WHEN jalur.name = "Perguruan Swasta" THEN 1 ELSE 0 END) as jumlah_lulusan_perguruan_swasta'),
                                DB::raw('SUM(CASE WHEN jalur.name = "Kedinasan" THEN 1 ELSE 0 END) as jumlah_lulusan_kedinasan'),
                                DB::raw('COUNT(*) as jumlah_total')
                           )
                           ->groupBy('sekolah.name','sekolah.id')
                           ->orderBy('sekolah.name')
                           ->get();
        }

        
        if($user_login->role_id==1){
            $results = DB::table('users')
               ->join('jalur', 'users.jalur_id', '=', 'jalur.id')
               ->join('kota', 'users.kota_id', '=', 'kota.id')
               ->select(
                    'kota.name as nama_kota',
                    'kota.id as kota_id',
                    DB::raw('SUM(CASE WHEN jalur.name = "SNBP" THEN 1 ELSE 0 END) as jumlah_lulusan_snbp'),
                    DB::raw('SUM(CASE WHEN jalur.name = "SNBT" THEN 1 ELSE 0 END) as jumlah_lulusan_snbt'),
                    DB::raw('SUM(CASE WHEN jalur.name = "SPAN SPTKIN" THEN 1 ELSE 0 END) as jumlah_lulusan_span_sptkin'),
                    DB::raw('SUM(CASE WHEN jalur.name = "Perguruan Swasta" THEN 1 ELSE 0 END) as jumlah_lulusan_perguruan_swasta'),
                    DB::raw('SUM(CASE WHEN jalur.name = "Kedinasan" THEN 1 ELSE 0 END) as jumlah_lulusan_kedinasan'),
                    DB::raw('COUNT(*) as jumlah_total')
               )
               ->groupBy(['kota.name','kota_id'])
               ->orderBy('kota.name')
               ->get();
        }

      




        
        $user = User::where($conditions)->get();
        $total_user = count($user);
        return view('home',compact('total_user','total_sekolah','results'));
    }
    public function login(){
        return view('login');
    }

    public function login_process(LoginRequest $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        return redirect()->back()->withInput()->withErrors([
            'password' => 'Username atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function change_password(){
        return view('change_password');
    }
    public function proses_change_password(Request $request){
        $request->validate([
            'old_password' => 'required|string|max:255',
            'new_password' => 'required|string|max:255',
        ]);
        $user = Auth::user();
        // Cek apakah password lama cocok
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors([
                'old_password' => 'Password saat ini tidak cocok.',
            ]);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();
        // dd("Berhasil ganti password");

        return redirect()->back()->with('success','berhasil ganti password');
    }
}
