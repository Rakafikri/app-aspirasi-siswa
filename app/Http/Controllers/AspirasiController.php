<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class AspirasiController extends Controller
{
    public function index()
    {
        $aspirasi = Aspirasi::with('kategori')->get();
        return view('aspirasi.index', compact('aspirasi'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('aspirasi.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'feedback' => 'nullable|string'
        ]);

        Aspirasi::create($request->all());
        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        $kategori = Kategori::all();
        return view('aspirasi.edit', compact('aspirasi', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'feedback' => 'nullable|string'
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update($request->all());
        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil diupdate');
    }

    public function destroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->delete();
        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil dihapus');
    }
}
