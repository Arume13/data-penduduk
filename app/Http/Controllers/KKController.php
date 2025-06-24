<?php

namespace App\Http\Controllers;

use App\Models\KK;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class KKController extends Controller
{
    public function index()
    {
        $dataKK = KK::withCount('penduduk')->get()->map(function ($kk) {
            return [
                'noKK' => $kk->noKK,
                'kepalaKeluarga' => $kk->kepalaKeluarga,
                'alamat' => $kk->alamat,
                'rt' => $kk->rt,
                'rw' => $kk->rw,
                'noRumah' => $kk->noRumah,
                'totalAnggota' => $kk->penduduk_count
            ];
        });
        return Inertia::render('KK/Index', [
            'dataKK' => $dataKK,
            'userRole' => auth()->check() ? auth()->user()->role : null,
            'breadcrumbs' => [
                ['title' => 'Data KK', 'href' => '/data-kk']
            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('KK/Create', [
            'breadcrumbs' => [
                ['title' => 'Data KK', 'href' => route('kk.index')],
                ['title' => 'Tambah KK', 'href' => route('kk.create')]
            ]
        ]);
    }

    public function show($noKK)
    {
        $kk = KK::where('noKK', $noKK)->firstOrFail();
        $penduduk = Penduduk::where('noKK', $noKK)->get();

        return Inertia::render('KK/Show', [
            'kk' => $kk,
            'penduduk' => $penduduk,
            'breadcrumbs' => [
                ['title' => 'Data KK', 'href' => '/data-kk'],
                ['title' => 'Detail KK', 'href' => '/data-kk/' . $noKK]
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'noKK' => 'required|unique:kk',
            'kepalaKeluarga' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'noRumah' => 'required',
        ]);

        KK::create($request->only(['noKK', 'kepalaKeluarga', 'alamat', 'rt', 'rw', 'noRumah']));

        return redirect()->route('kk.index')->with('success', 'Data KK berhasil ditambahkan');
    }

    public function edit($noKK)
    {
        $kk = KK::where('noKK', $noKK)->firstOrFail();

        return Inertia::render('KK/Edit', [
            'kk' => $kk,
            'breadcrumbs' => [
                ['title' => 'Data KK', 'href' => route('kk.index')],
                ['title' => 'Edit KK', 'href' => route('kk.edit', $noKK)]
            ]
        ]);
    }

    public function update(Request $request, $noKK)
    {
        $kk = KK::where('noKK', $noKK)->firstOrFail();

        $request->validate([
            'kepalaKeluarga' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'noRumah' => 'required',
        ]);

        $kk->update($request->only(['kepalaKeluarga', 'alamat', 'rt', 'rw', 'noRumah']));

        return redirect()->route('kk.index')->with('success', 'Data KK berhasil diperbarui');
    }

    public function destroy($noKK)
    {
        $kk = KK::where('noKK', $noKK)->firstOrFail();

        // Check if the user is an "anggota"
        if (Auth::user()->role === 'anggota') {
            return redirect()->route('kk.index')->with('error', 'Anda tidak memiliki izin untuk menghapus data KK.');
        }

        $kk->delete();

        return redirect()->route('kk.index')->with('success', 'Data KK berhasil dihapus');
    }
}
