<?php

namespace App\Http\Controllers;

use App\Models\Klpcm;
use App\Models\KlpcmDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistribusiController extends Controller
{
    //

    public function index()
    {
        $klpcms = Klpcm::with('detail')->paginate(10);
        return view("pages.distribusi.index", compact('klpcms'));
    }

    public function destroy($id)
    {
        Klpcm::findOrFail($id)->delete();
        return back()->with('success', 'berhasil menghapus distribusi rekam medisS');
    }




    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'no_rm' => 'required|exists:data_pasien,no_rm',
                'kode_wilayah' => 'required',
                'nama_string' => 'required',
                'keperluan' => 'required',
                'poli' => 'required',
                'nama_peminjam' => 'required',
                'tanggal_pinjam' => 'required|date',
                'tanggal_kembali' => 'required|date|same:tanggal_pinjam',
                'no_wa' => 'required|max:15, min:11'
            ],
            [
                'no_rm.exists' => 'No rm belum di input ke data pasien!'
            ]
        );


        $klpcm = Klpcm::updateOrCreate([
            'no_rm' => $request->no_rm,
        ], [
            'no_rm' => $request->no_rm
        ]);

        $validated['klpcm_id'] = $klpcm->id;
        unset($validated['no_rm']);

        KlpcmDetail::create(
            $validated
        );

        return back()->with('success', 'Berhasil mendistribusikan rekam medis');
    }

    public function laporan(Request $request)
    {
        $data = DB::table('klpcm_detail')
            ->select(
                'poli',
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
            ->groupBy('poli')
            ->get()
            ->toArray();

        return view("pages.distribusi.laporan", compact('data'));
    }

    public function exportLaporan(Request $request)
    {


        $request->validate(
            [
                'bulan' => 'required',
                'tahun' => 'required'
            ]
        );

        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $namaBulan = $this->getNamaBulan($bulan);

        $data = DB::table('klpcm_detail')
            ->select(
                'poli',
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
            ->whereMonth('tanggal_pinjam', $bulan)
            ->whereYear('tanggal_pinjam', $tahun)
            ->groupBy('poli')
            ->get()->toArray();

        return view("pages.distribusi.pdf", compact('data', 'bulan', 'tahun', 'namaBulan'));
    }



    private function getNamaBulan($bulan)
    {
        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        return $namaBulan[$bulan];
    }
}
