@extends('layout/aplikasi')

@section('konten')
   <div>
        <a href='/siswa' class="btn btn-secondary"><< Kembali</a>
        <h1>{{ $data->nama }}</h1>
        <p>
            <b>Nomor Induk</b> {{ $data->nomor_induk}}
        </p>
        <p>
            <b>Email</b> {{ $data->email}}
        </p>
   </div>
@endsection
