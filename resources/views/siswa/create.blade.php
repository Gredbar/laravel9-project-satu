@extends('layout/aplikasi')

@section('konten')
    <form method="post" action="/siswa" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nomor_induk" class="form-label">Nomor Induk</label>
            <input type="text" class="form-control" name='nomor_induk' id="nomor_induk" value="{{ Session::get('nomor_induk')}}">
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name='nama' id="nama" value="{{ Session::get('nama')}}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ Session::get('email')}}">
        </div>
        <div class="mb-3">
            <label for="companies" class="form-label">Company</label>
            <select type="text" class="form-control" name="companies">
                <option value="">-- Pilih --</option>
                @foreach ($companies as $item)
                <option value="{{$item->nama}}"> {{$item->nama}} </option>
                @endforeach

            </select>
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
