<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Admin lihat semua, Siswa lihat punya mereka sendiri
        if (Auth::user()->role === 'admin') {
            // Sorting: default terbaru (desc), bisa pilih oldest (asc)
            $sortOrder = $request->get('sort', 'desc');
            $aspirasi = Aspirasi::with(['user', 'kategori'])
                ->orderBy('created_at', $sortOrder)
                ->get();
        } else {
            $aspirasi = Aspirasi::with(['user', 'kategori'])
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return view('aspirasi.index', compact('aspirasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('aspirasi.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'lokasi' => 'required|string|max:50',
            'kel' => 'required|string|max:255'
        ]);

        Aspirasi::create([
            'user_id' => Auth::id(),
            'id_kategori' => $request->id_kategori,
            'lokasi' => $request->lokasi,
            'kel' => $request->kel,
            'status' => 'Menunggu',
        ]);

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $aspirasi = Aspirasi::with(['user', 'kategori'])->findOrFail($id);
        
        // Cek akses: Siswa hanya bisa lihat punya mereka sendiri
        if (Auth::user()->role === 'siswa' && $aspirasi->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk melihat aspirasi ini.');
        }
        
        return view('aspirasi.show', compact('aspirasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Hanya admin yang bisa edit
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat mengupdate aspirasi.');
        }
        
        $aspirasi = Aspirasi::with(['user', 'kategori'])->findOrFail($id);
        return view('aspirasi.edit', compact('aspirasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Hanya admin yang bisa update
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat mengupdate aspirasi.');
        }

        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'nullable|string'
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update([
            'status' => $request->status,
            'feedback' => $request->feedback
        ]);

        return redirect()->route('aspirasi.show', $id)->with('success', 'Aspirasi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Hanya admin yang bisa delete
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat menghapus aspirasi.');
        }

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->delete();

        return redirect()->route('aspirasi.index')->with('success', 'Aspirasi berhasil dihapus!');
    }
}