<?php

namespace App\Http\Controllers;

use App\Models\KK;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     // Menghitung total Kartu Keluarga
    //     $totalKK = KK::count();

    //     // Menghitung total penduduk
    //     $totalPenduduk = Penduduk::count();

    //     // Menghitung jumlah penduduk berdasarkan kategori
    //     $kategoriCounts = Penduduk::selectRaw('
    //         SUM(CASE WHEN kategori = "Bayi" THEN 1 ELSE 0 END) AS Bayi,
    //         SUM(CASE WHEN kategori = "Anak-Anak" THEN 1 ELSE 0 END) AS AnakAnak,
    //         SUM(CASE WHEN kategori = "Remaja" THEN 1 ELSE 0 END) AS Remaja,
    //         SUM(CASE WHEN kategori = "Dewasa" THEN 1 ELSE 0 END) AS Dewasa,
    //         SUM(CASE WHEN kategori = "Lansia" THEN 1 ELSE 0 END) AS Lansia
    //     ')->first();

    //     // Mengirim data ke tampilan dashboard
    //     return Inertia::render('Dashboard', [
    //         'totalKK' => $totalKK,
    //         'totalPenduduk' => $totalPenduduk,
    //         'kategoriData' => [
    //             'Bayi' => $kategoriCounts->Bayi,
    //             'AnakAnak' => $kategoriCounts->AnakAnak,
    //             'Remaja' => $kategoriCounts->Remaja,
    //             'Dewasa' => $kategoriCounts->Dewasa,
    //             'Lansia' => $kategoriCounts->Lansia,
    //         ],
    //     ]);
    // }

    public function index()
    {
        // Total KK
        $totalKK = KK::count();

        // Total Penduduk
        $totalPenduduk = Penduduk::count();

        // Distribusi Kategori
        $kategoriData = Penduduk::selectRaw('
            SUM(CASE WHEN kategori = "Bayi" THEN 1 ELSE 0 END) AS Bayi,
            SUM(CASE WHEN kategori = "Anak-Anak" THEN 1 ELSE 0 END) AS AnakAnak,
            SUM(CASE WHEN kategori = "Remaja" THEN 1 ELSE 0 END) AS Remaja,
            SUM(CASE WHEN kategori = "Dewasa" THEN 1 ELSE 0 END) AS Dewasa,
            SUM(CASE WHEN kategori = "Lansia" THEN 1 ELSE 0 END) AS Lansia
        ')->first();

        // Distribusi Jenis Kelamin
        $jenisKelaminData = Penduduk::selectRaw('
            SUM(CASE WHEN jenisKelamin = "Laki-laki" THEN 1 ELSE 0 END) AS LakiLaki,
            SUM(CASE WHEN jenisKelamin = "Perempuan" THEN 1 ELSE 0 END) AS Perempuan
        ')->first();

        // Pertumbuhan Penduduk 12 Bulan Terakhir
        $pendudukByMonth = Penduduk::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->map(function ($item) {
                return [
                    'month' => date('M', mktime(0, 0, 0, $item->month, 1)),
                    'count' => $item->count
                ];
            });
        $stats = [
            'totalIbuHamil' => Penduduk::where('ibu_hamil', true)->count(),
            'totalIbuMenyusui' => Penduduk::where('ibu_menyusui', true)->count(),
            'totalBerkebutuhanKhusus' => Penduduk::where('berkebutuhan_khusus', true)->count()
        ];

        return Inertia::render('Dashboard', [
            'totalKK' => $totalKK,
            'totalPenduduk' => $totalPenduduk,
            'kategoriData' => $kategoriData,
            'jenisKelaminData' => $jenisKelaminData,
            'pendudukByMonth' => $pendudukByMonth,
            'totalIbuHamil' => $stats['totalIbuHamil'],
            'totalIbuMenyusui' => $stats['totalIbuMenyusui'],
            'totalBerkebutuhanKhusus' => $stats['totalBerkebutuhanKhusus']

        ]);
    }
}
