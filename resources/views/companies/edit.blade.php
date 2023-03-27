@extends('layout/aplikasi')

@section('konten')
    <a href='/companies' class="btn btn-secondary"><< Kembali</a>
    <form method="post" action="{{ '/companies/'.$companies->id }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
            <h1>Id Employee: {{ $companies->id}}</h1>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name='nama' id="nama" value="{{ $companies->nama }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value=" {{$companies->email }}">
        </div>
        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="website" class="form-control" name="website" value=" {{$companies->website }}">
        </div>
        @if ($companies->foto)
            <div class="mb-3">
                <img style="max-width:50px;max-height:50px" src="{{ url('storage/company').'/'.$companies->foto }}"/>
            </div>
        @endif
        <div class="mb-3">
            <label for="foto" class="form-label">Logo</label>
            <input type="file" class="form-control" name="foto" id="foto">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">UPDATE</button>
        </div>
    </form>
@endsection
