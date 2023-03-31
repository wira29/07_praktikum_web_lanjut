<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MahasiswaController extends Controller
{

    public function cariMahasiswa(Request $request)
    {
        $cari = $request->cari;
        $mahasiswas = Mahasiswa::where('nama', 'like', '%'.$cari.'%')->paginate(5);
        return view('mahasiswas.index', compact('mahasiswas'));
    }

    public function index()
    {
//        $mahasiswas = Mahasiswa::all();
//        $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);
//        with('i', (request()->input('page', 1) - 1) * 5);

        $mahasiswas = Mahasiswa::paginate(5);
        return view('mahasiswas.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_handphone' => 'required',
        ]);
        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    public function show($nim)
    {
        $mahasiswa = Mahasiswa::find($nim);
        return view('mahasiswas.detail', compact('mahasiswa'));

    }

    public function edit($nim)
    {
        $mahasiswa = Mahasiswa::find($nim);
        return view('mahasiswas.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $nim)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_handphone' => 'required',
        ]);

        Mahasiswa::find($nim)->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    public function destroy($nim)
    {
        Mahasiswa::find($nim)->delete();
        return redirect()->route('mahasiswa.index')-> with('success', 'Mahasiswa Berhasil Dihapus');

    }
}
