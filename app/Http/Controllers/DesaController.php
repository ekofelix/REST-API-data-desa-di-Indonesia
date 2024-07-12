<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    // Menampilkan daftar desa
    public function index()
    {
        return Desa::all();
    }

    // Menampilkan detil sebuah desa
    public function show($id)
    {
        return Desa::findOrFail($id);
    }

    // Menambah desa baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
        ]);

        return Desa::create($validated);
    }

    // Mengupdate desa tertentu
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kode_pos' => 'nullable|string|max:10',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
        ]);

        $desa = Desa::findOrFail($id);
        $desa->update($validated);

        return $desa;
    }

    // Menghapus desa tertentu
    public function destroy($id)
    {
        $desa = Desa::findOrFail($id);
        $desa->delete();

        return response()->json(null, 204);
    }
}
