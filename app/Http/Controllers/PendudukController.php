<?php

namespace App\Http\Controllers;

use App\Models\KK;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PendudukController extends Controller
{
    public function index()
    {
        $penduduk = Penduduk::with('kk')->paginate(10);

        return Inertia::render('Penduduk/Index', [
            'penduduk' => $penduduk,
            'userRole' => auth()->check() ? auth()->user()->role : null,
            'breadcrumbs' => [
                ['title' => 'Data Penduduk', 'href' => route('penduduk.index')]
            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('Penduduk/Create', [
            'kkList' => KK::select('noKK', 'kepalaKeluarga')->get(),
            'breadcrumbs' => [
                ['title' => 'Data Penduduk', 'href' => route('penduduk.index')],
                ['title' => 'Tambah Penduduk', 'href' => route('penduduk.create')]
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'noKK' => 'required|exists:kk,noKK',
            'nik' => 'required|unique:penduduk,nik|digits:16',
            'nama' => 'required|string|max:100',
            'tempatLahir' => 'required|string|max:50',
            'tanggalLahir' => 'required|date',
            'jenisKelamin' => 'required|in:Laki-laki,Perempuan',
            'pekerjaan' => 'required|string|max:50',
            'kategori' => 'required|in:Bayi,Anak-Anak,Remaja,Dewasa,Lansia',
            'statusPerkawinan' => 'required|in:Belum Menikah,Menikah,Cerai',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'noRumah' => 'required|string|max:10'
        ]);

        Penduduk::create($request->all());

        return redirect()->route('penduduk.index')
            ->with('message', 'Data penduduk berhasil ditambahkan')
            ->with('type', 'success');
    }

    public function show($nik)
    {
        $penduduk = Penduduk::with('kk')->findOrFail($nik);

        return Inertia::render('Penduduk/Show', [
            'penduduk' => $penduduk,
            'breadcrumbs' => [
                ['title' => 'Data Penduduk', 'href' => route('penduduk.index')],
                ['title' => 'Detail Penduduk', 'href' => route('penduduk.show', $nik)]
            ]
        ]);
    }

    public function edit($nik)
    {
        $penduduk = Penduduk::findOrFail($nik);

        return Inertia::render('Penduduk/Edit', [
            'penduduk' => $penduduk,
            'kkList' => KK::select('noKK', 'kepalaKeluarga')->get(),
            'breadcrumbs' => [
                ['title' => 'Data Penduduk', 'href' => route('penduduk.index')],
                ['title' => 'Edit Penduduk', 'href' => route('penduduk.edit', $nik)]
            ]
        ]);
    }

    public function update(Request $request, $nik)
    {
        $request->validate([
            'noKK' => 'required|exists:kk,noKK',
            'nik' => 'required|digits:16|unique:penduduk,nik,'.$nik.',nik',
            'nama' => 'required|string|max:100',
            'tempatLahir' => 'required|string|max:50',
            'tanggalLahir' => 'required|date',
            'jenisKelamin' => 'required|in:Laki-laki,Perempuan',
            'pekerjaan' => 'required|string|max:50',
            'kategori' => 'required|in:Bayi,Anak-Anak,Remaja,Dewasa,Lansia',
            'statusPerkawinan' => 'required|in:Belum Menikah,Menikah,Cerai',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'noRumah' => 'required|string|max:10'
        ]);

        $penduduk = Penduduk::findOrFail($nik);
        $penduduk->update($request->all());

        return redirect()->route('penduduk.index')
            ->with('message', 'Data penduduk berhasil diperbarui')
            ->with('type', 'success');
    }

    public function destroy($nik)
    {
        $penduduk = Penduduk::findOrFail($nik);
        $penduduk->delete();

        return redirect()->route('penduduk.index')
            ->with('message', 'Data penduduk berhasil dihapus')
            ->with('type', 'success');
    }
}
