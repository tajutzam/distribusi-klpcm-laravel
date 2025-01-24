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

        // Query untuk mendapatkan data
        $data = DB::table('klpcm_detail')
            ->select(
                DB::raw('COUNT(*) as rekam_medis_keluar'),
                DB::raw(
                    "
                    SUM(
                        CASE
                            WHEN status_kembali = 'kembali'
                            AND TIMESTAMPDIFF(HOUR, tanggal_pinjam, tanggal_kembali) <= 24
                            THEN 1
                            ELSE 0
                        END
                    ) as rekam_medis_kembali_24"
                ),
                DB::raw(
                    "
                    SUM(
                        CASE
                            WHEN status_kembali = 'kembali'
                            AND TIMESTAMPDIFF(HOUR, tanggal_pinjam, tanggal_kembali) > 24
                            THEN 1
                            ELSE 0
                        END
                    ) as rekam_medis_kembali_24_plus"
                )
            )
            ->when($request->has('bulan'), function ($query) use ($request) {
                $query->whereMonth('tanggal_pinjam', $request->input('bulan'));
            })
            ->when($request->has('tahun'), function ($query) use ($request) {
                $query->whereYear('tanggal_pinjam', $request->input('tahun'));
            })
            ->whereMonth('tanggal_pinjam', $bulan)
            ->whereYear('tanggal_pinjam', $tahun)
            ->get()
            ->first(); // Ambil data pertama karena hanya satu bulan dan tahun

        // Data yang akan diteruskan ke view untuk grafik
        $rekamMedis24Jam = $data->rekam_medis_kembali_24 ?? 0;
        $rekamMedis24PlusJam = $data->rekam_medis_kembali_24_plus ?? 0;


        $bulan = Carbon::now()->month;
        $tahun = Carbon::now()->year;

        // Query untuk mendapatkan jumlah lengkap dan tidak lengkap
        $data = DB::table('klpcm_detail')
            ->select(
                'poli',
                DB::raw(
                    "
                    SUM(
                        CASE
                            WHEN status_lengkap = 'lengkap'
                            THEN 1
                            ELSE 0
                        END
                    ) as rekam_medis_lengkap"
                ),
                DB::raw(
                    "
                    SUM(
                        CASE
                            WHEN status_lengkap = 'belum-lengkap'
                            THEN 1
                            ELSE 0
                        END
                    ) as rekam_medis_tidak_lengkap"
                )
            )
            ->whereMonth('tanggal_pinjam', $bulan)
            ->whereYear('tanggal_pinjam', $tahun)
            ->groupBy('poli')
            ->get();



        // Mendapatkan jumlah lengkap dan tidak lengkap secara keseluruhan
        $totalLengkap = $data->sum('rekam_medis_lengkap');
        $totalTidakLengkap = $data->sum('rekam_medis_tidak_lengkap');


        $totalRecords = DB::table('klpcm_detail')
            ->whereMonth('tanggal_pinjam', $bulan)
            ->whereYear('tanggal_pinjam', $tahun)
            ->count();

        $persenLengkap = $totalRecords > 0 ? ($totalLengkap / $totalRecords) * 100 : 0;
        $persenTidakLengkap = $totalRecords > 0 ? ($totalTidakLengkap / $totalRecords) * 100 : 0;

        return view("pages.dashboard", compact('rekamMedis24Jam', 'rekamMedis24PlusJam', 'totalLengkap', 'totalTidakLengkap', 'persenLengkap', 'persenTidakLengkap'));
    }
}
