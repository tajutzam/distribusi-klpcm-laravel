<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        $bulan = Carbon::now()->month;
        $tahun = Carbon::now()->year;

        $poliList = ['Poli Umum', 'Poli Gigi', "Poli KIA/KB", "Poli MTBS"];

        // Data Distribusi per Poli
        $distribusiPerPoli = DB::table('klpcm_detail')
            ->select(
                'poli',
                DB::raw('SUM(CASE WHEN tanggal_dikembalikan <= tanggal_kembali THEN 1 ELSE 0 END) as tepat_waktu'),
                DB::raw('SUM(CASE WHEN IFNULL(tanggal_dikembalikan, NOW()) > tanggal_kembali THEN 1 ELSE 0 END) as terlambat')
            )
           
            ->groupBy('poli')
            ->get()
            ->keyBy('poli');

        foreach ($poliList as $poli) {
            if (!isset($distribusiPerPoli[$poli])) {
                $distribusiPerPoli[$poli] = (object) [
                    'poli' => $poli,
                    'tepat_waktu' => 0,
                    'terlambat' => 0
                ];
            }
        }

        // Data Kelengkapan per Poli
        $kelengkapanPerPoli = DB::table('klpcm_detail')
            ->select(
                'poli',
                DB::raw("COUNT(*) as total"),
                DB::raw("SUM(CASE WHEN status_lengkap = 'lengkap' THEN 1 ELSE 0 END) as lengkap"),
                DB::raw("SUM(CASE WHEN status_lengkap = 'belum-lengkap' THEN 1 ELSE 0 END) as tidak_lengkap")
            )
            ->whereMonth('tanggal_pinjam', $bulan)
            ->whereYear('tanggal_pinjam', $tahun)
            ->groupBy('poli')
            ->get()
            ->keyBy('poli'); // Buat indeks berdasarkan nama poli

        // Pastikan semua poli ada dalam hasil
        foreach ($poliList as $poli) {
            if (!isset($kelengkapanPerPoli[$poli])) {
                $kelengkapanPerPoli[$poli] = (object) [
                    'poli' => $poli,
                    'total' => 0,
                    'lengkap' => 0,
                    'tidak_lengkap' => 0,
                    'persen_lengkap' => 0,
                    'persen_tidak_lengkap' => 0
                ];
            } else {
                // Hitung persentase
                $kelengkapanPerPoli[$poli]->persen_lengkap = $kelengkapanPerPoli[$poli]->total > 0
                    ? ($kelengkapanPerPoli[$poli]->lengkap / $kelengkapanPerPoli[$poli]->total) * 100
                    : 0;
                $kelengkapanPerPoli[$poli]->persen_tidak_lengkap = $kelengkapanPerPoli[$poli]->total > 0
                    ? ($kelengkapanPerPoli[$poli]->tidak_lengkap / $kelengkapanPerPoli[$poli]->total) * 100
                    : 0;
            }
        }

        return view("pages.dashboard", [
            'distribusiPerPoli' => $distribusiPerPoli->values(),
            'kelengkapanPerPoli' => $kelengkapanPerPoli->values()
        ]);
    }
}
