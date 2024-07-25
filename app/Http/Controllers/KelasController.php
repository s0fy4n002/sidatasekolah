<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasRequest;
use App\Models\Kelas;
use App\Models\Level;
use Exception;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(){
        $kelass = Kelas::all();
        $title = "Halaman Kelas";
        return view('kelas.index', compact('kelass','title'));
    }

    public function create()
    {
        $levels = Level::all();
        return view('kelas.create', compact('levels'));
    }

    public function store(KelasRequest $request)
    {       
        $kelas = new Kelas();
        $kelas->tingkatan_id = $request->tingkatan_id;
        $kelas->name = $request->name;
        try {
            $kelas->save();  
            return redirect()->route('kelas.index')
            ->with('success', 'Berhasil Menambahkan Kelas Baru');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function show(Kelas $kelas)
    {
        return view('kelas.show', compact('kelas'));
    }

    public function edit(Kelas $kelas)
    {
        $levels = Level::all();
        return view('kelas.edit', compact('kelas','levels'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tingkatan_id' => 'required',
        ]);

        $kelas->update($request->all());
        return redirect()->route('kelas.index')
                         ->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')
                         ->with('success', 'kelas berhasil dihapus.');
    }
}
