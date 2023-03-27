@extends('layout/aplikasi')

@section('konten')
   <div>
        <a href='/companies' class="btn btn-secondary"><< Kembali</a>
        <h1>{{ $companies->nama }}</h1>
        <p>
            <b>Id Employee</b> {{ $data->id}}
        </p>
        <p>
            <b>Email</b> {{ $comapanies->email}}
        </p>
   </div>
@endsection
