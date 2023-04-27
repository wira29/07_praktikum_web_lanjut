@extends('mahasiswas.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
        </div>
    </div>
        <form class="row mb-3 mt-5" action="{{ route('cariMahasiswa') }}" method="GET">
        @csrf
            <div class="col-md-6">
                <div class="d-flex flex-row">
                    <input type="text" value="{{ (request()->cari) ? request()->cari : '' }}" name="cari" class="form-control" placeholder="cari mahasiswa">
                    <button type="submit" class="btn btn-primary ml-3">Cari</button>
                </div>
            </div>
            <div class="col-md-6 d-flex flex-row justify-content-end">
                <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
            </div>
        </form>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>No_Handphone</th>
            <th>Tanggal Lahir</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($mahasiswas as $mahasiswa)
            <tr>

                <td>{{ $mahasiswa->nim }}</td>
                <td>{{ $mahasiswa->nama }}</td>
                <td>{{ $mahasiswa->email }}</td>
                <td>{{ $mahasiswa->kelas->nama_kelas }}</td>
                <td>{{ $mahasiswa->jurusan }}</td>
                <td>{{ $mahasiswa->no_handphone }}</td>
                <td>{{ $mahasiswa->tanggal_lahir }}</td>
                <td>
                    <form action="{{ route('mahasiswa.destroy',$mahasiswa->nim) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('mahasiswa.show',$mahasiswa->nim) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('mahasiswa.edit',$mahasiswa->nim) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="row">
        <div class="col-md-12">
            {{ $mahasiswas->links() }}
        </div>
    </div>
@endsection
