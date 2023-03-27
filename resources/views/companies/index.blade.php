@extends('layout/aplikasi')

@section('konten')
    <a href="/companies/create" class="btn btn-primary">+Tambah Data Company</a>
    <table class="table">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Id Employee</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Website</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $item)
                <tr>
                    <td>
                        @if ($item->foto)
                            <img style="max-width:50px;max-height:50px" src="{{ url('storage/company').'/'.$item->foto }}"/>
                        @endif
                    </td>
                    <td>{{ $item->id}}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->website }}</td>
                    <td>
                        <a class='btn btn-secondary btn-sm' href='{{ url('/companies/'.$item->id) }}'>Detail</a>
                        <a class='btn btn-warning btn-sm' href='{{ url('/companies/'.$item->id.'/edit') }}'>Edit</a>
                        <form onsubmit="return confirm('Yakin mau hapus data?')" class='d-inline' action="{{ '/companies/'.$item->id }}" method='post'>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Del</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $companies->links() }}
@endsection
