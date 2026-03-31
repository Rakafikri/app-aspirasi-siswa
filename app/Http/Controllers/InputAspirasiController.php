<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputAspirasiController extends Controller
{
    public function index()
    {
        $aspirasi = InputAspirasi::with(['siswa', 'kategori'])->get();
        return view('input-aspirasi.index', compact('aspirasi'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $kategori = Kategori::all();
        return view('input-aspirasi.create', compact('siswa', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|exists:siswa,nis',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'lokasi' => 'required|string|max:50',
            'kel' => 'required|string|max:50'
        ]);

        InputAspirasi::create($request->all());
        return redirect()->route('input-aspirasi.index')->with('success', 'Aspirasi berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $aspirasi = InputAspirasi::findOrFail($id);
        $aspirasi->delete();
        return redirect()->route('input-aspirasi.index')->with('success', 'Aspirasi berhasil dihapus');
    }
}
