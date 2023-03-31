@extends('mahasiswas.layout')

@section('content')

    <div class="container mt-5">

        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Edit Mahasiswa
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('mahasiswa.update', $mahasiswa->nim) }}" id="myForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nim">Nim</label>
                            <input type="text" name="nim" class="form-control" id="nim" value="{{ $mahasiswa->nim }}" ariadescribedby="nim" >
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" value="{{ $mahasiswa->nama }}" ariadescribedby="nama" >
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" name="email" class="form-control" id="Email" value="{{ $mahasiswa->email }}" aria-describedby="email" >
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" name="kelas" class="form-control" id="kelas" value="{{ $mahasiswa->kelas }}" ariadescribedby="kelas" >
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" id="jurusan" value="{{ $mahasiswa->jurusan }}" ariadescribedby="jurusan" >
                        </div>
                        <div class="form-group">
                            <label for="no_handphone">No Handphone</label>

                            <input type="text" name="no_handphone" class="form-control" id="no_handphone" value="{{ $mahasiswa->no_handphone }}" ariadescribedby="no_handphone" >
                        </div>
                        <div class="form-group">
                            <label for="TanggalLahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" id="TanggalLahir" value="{{ $mahasiswa->tanggal_lahir }}" aria-describedby="Tanggal Lahir" >
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
