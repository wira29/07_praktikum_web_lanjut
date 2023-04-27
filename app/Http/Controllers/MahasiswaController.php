<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
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
        $mahasiswas = Mahasiswa::with('kelas')->get();
//        $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);
//        with('i', (request()->input('page', 1) - 1) * 5);

        $mahasiswas = Mahasiswa::with('kelas')->paginate(5);
        return view('mahasiswas.index', compact('mahasiswas'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswas.create', ['kelas' => $kelas]);
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
//        Mahasiswa::create($request->all());
        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->get('nim');
        $mahasiswa->nama = $request->get('nama');
        $mahasiswa->email = $request->get('email');
        $mahasiswa->jurusan = $request->get('jurusan');
        $mahasiswa->no_handphone = $request->get('no_handphone');
        $mahasiswa->tanggal_lahir = $request->get('tanggal_lahir');
        $mahasiswa->kelas_id = $request->get('kelas');
        $mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    public function show($nim)
    {
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        return view('mahasiswas.detail', compact('mahasiswa'));

    }

    public function edit($nim)
    {
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $kelas = Kelas::all();
        return view('mahasiswas.edit', compact('mahasiswa', 'kelas'));
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

//        Mahasiswa::find($nim)->update($request->all());
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $mahasiswa->nim = $request->get('nim');
        $mahasiswa->nama = $request->get('nama');
        $mahasiswa->email = $request->get('email');
        $mahasiswa->jurusan = $request->get('jurusan');
        $mahasiswa->no_handphone = $request->get('no_handphone');
        $mahasiswa->tanggal_lahir = $request->get('tanggal_lahir');
        $mahasiswa->kelas_id = $request->get('kelas');
        $mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    public function destroy($nim)
    {
        Mahasiswa::find($nim)->delete();
        return redirect()->route('mahasiswa.index')-> with('success', 'Mahasiswa Berhasil Dihapus');

    }
}
