@extends('layout/aplikasi')

@section('konten')
    <form method="post" action="/companies" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">Id Company</label>
            <input type="id" class="form-control" name='id' id="id" value="{{ Session::get('id')}}">
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Company</label>
            <input type="text" class="form-control" name='nama' id="nama" value="{{ Session::get('nama')}}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ Session::get('email')}}">
        </div>
        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="website" class="form-control" name="website" value="{{ Session::get('website')}}">
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" name="foto" id="foto">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">SIMPAN</button>
        </div>
    </form>
@endsection
