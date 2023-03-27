<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = company::orderBy('id', 'desc')->paginate(5);
        return view('companies/index')->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('id', $request->id);
        Session::flash('nama', $request->nama);
        Session::flash('email', $request->email);
        Session::flash('website', $request->website);

        $request->validate([
            'id' => 'required|numeric',
            'nama' => 'required',
            'email' => 'required',
            'website' => 'required',
            'foto' => 'required|mimes:jpeg,jpg,png,gif'
        ], [
            'id.required' => 'Nomor induk wajib diisi',
            'id.numeric' => 'Nomor induk wajib diisi dalam angka',
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'website.required' => 'Website wajib diisi',
            'foto.required' => 'Silakan masukkan foto',
            'foto.mimes' => 'Foto hanya diperbolehkan berekstensi JPEG, JPG, PNG, dan GIF'
        ]);

        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
        $foto_file->move(storage_path('app/public/company'), $foto_nama);

        $companies = [
            'id' => $request->input('id'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
            'foto' => $foto_nama
        ];
        company::create($companies);
        return redirect('companies')->with('success', 'Berhasil memasukkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companies = company::where('id', $id)->first();
        return view('companies/show')->with('companies', $companies);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = company::where('id', $id)->first();
        return view('companies/edit')->with('companies', $companies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'website' => 'required'
        ], [
            'id.numeric' => 'Id wajib diisi dalam angka',
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'website.required' => 'website wajib diisi',
        ]);

        $companies = [
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
        ];

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'mimes:jpeg,jpg,png,gif'
            ], [
                'foto.mimes' => 'Foto hanya diperbolehkan berekstensi JPEG, JPG, PNG, dan GIF'
            ]);
            $foto_file = $request->file('foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(storage_path('app/public/company'), $foto_nama); //sudah terupload ke direktori

            $companies_foto = company::where('id', $id)->first();
            File::delete(storage_path('app/public/company') . '/' . $companies_foto->foto);

            // $data = [
            //     'foto' => $foto_nama
            // ];
            $companies['foto'] = $foto_nama;
        }

        company::where('id', $id)->update($companies);
        return redirect('/companies')->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companies = company::where('id', $id)->first();
        File::delete(storage_path('app/public/company') . '/' . $companies->foto);

        company::where('id', $id)->delete();
        return redirect('/companies')->with('success', 'Berhasil hapus data');
    }
}
