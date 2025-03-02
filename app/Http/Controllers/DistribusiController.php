<?php

namespace App\Http\Controllers;

use App\Models\Klpcm;
use App\Models\KlpcmDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistribusiController extends Controller
{
    //

    public function index()
    {
        $klpcms = KlpcmDetail::with('klpcm')->where('status_kembali', 'kembali')->whereNotNull('tanggal_dikembalikan')->paginate(10);
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
                'keperluan' => 'nullable',
                'keperluan_lainya' => 'required_if:keperluan,Lainnya',
                'poli' => 'required',
                'nama_peminjam' => 'required',
                'tanggal_pinjam' => 'required|date',
                'tanggal_kembali' => 'required|date',
                'no_wa' => 'required|max:15, min:11'
            ],
            [
                'no_rm.exists' => 'No rm belum di input ke data pasien!'
            ]
        );



        if (isset($validated['keperluan']) && $validated['keperluan'] == 'Lainnya') {
            $validated['keperluan'] = $validated['keperluan_lainya'];
        }

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
        // Ambil input bulan dan tahun, jika tidak ada, set ke null
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Daftar Poli yang harus selalu tampil
        $poliList = ['Poli Umum', 'Poli Gigi', 'Poli KIA/KB', 'Poli MTBS'];

        // Query dasar
        $query = DB::table('klpcm_detail')
            ->select(
                'poli',
                DB::raw('COUNT(*) as rekam_medis_keluar'),
                DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tanggal_pinjam, tanggal_dikembalikan) <= 24 THEN 1 ELSE 0 END) as rekam_medis_kembali_24'),
                DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tanggal_pinjam, tanggal_dikembalikan) > 24 THEN 1 ELSE 0 END) as rekam_medis_kembali_24_plus'),
                DB::raw('SUM(CASE WHEN tanggal_dikembalikan <= tanggal_kembali THEN 1 ELSE 0 END) as tepat_waktu'),
                DB::raw('SUM(CASE WHEN IFNULL(tanggal_dikembalikan, NOW()) > tanggal_kembali THEN 1 ELSE 0 END) as terlambat')
            )
            ->where('status_kembali', 'kembali');

        // Tambahkan filter jika bulan dan tahun diberikan
        if ($tahun) {
            $query->whereYear('tanggal_pinjam', $tahun);
        }

        if ($bulan) {
            $query->whereMonth('tanggal_pinjam', $bulan);
        }

        // Eksekusi query
        $data = $query->groupBy('poli')->get();

        // Convert data ke array yang mudah diakses
        $dataAssoc = [];
        foreach ($data as $item) {
            $dataAssoc[$item->poli] = $item;
        }

        // Pastikan semua poli dalam $poliList ada, tambahkan entri kosong jika tidak ada
        $finalData = [];
        foreach ($poliList as $poli) {
            if (isset($dataAssoc[$poli])) {
                $finalData[] = $dataAssoc[$poli];
            } else {
                // Poli tidak memiliki data, buat entri kosong
                $finalData[] = (object)[
                    'poli' => $poli,
                    'rekam_medis_keluar' => 0,
                    'rekam_medis_kembali_24' => 0,
                    'rekam_medis_kembali_24_plus' => 0,
                    'tepat_waktu' => 0,
                    'terlambat' => 0
                ];
            }
        }

        $data = $finalData;

        // Kembalikan data ke view
        return view("pages.distribusi.laporan", compact('data'));
    }




    public function exportLaporan(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $namaBulan = $bulan ? $this->getNamaBulan($bulan) : null;

        // Daftar Poli yang harus selalu tampil
        $poliList = ['Poli Umum', 'Poli Gigi', 'Poli KIA/KB', 'Poli MTBS'];

        // Query data rekam medis per poli
        $query = DB::table('klpcm_detail')
            ->select(
                'poli',
                DB::raw('COUNT(*) as rekam_medis_keluar'),
                DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tanggal_pinjam, tanggal_dikembalikan) <= 24 THEN 1 ELSE 0 END) as rekam_medis_kembali_24'),
                DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(HOUR, tanggal_pinjam, tanggal_dikembalikan) > 24 THEN 1 ELSE 0 END) as rekam_medis_kembali_24_plus'),
                DB::raw('SUM(CASE WHEN tanggal_dikembalikan <= tanggal_kembali THEN 1 ELSE 0 END) as tepat_waktu'),
                DB::raw('SUM(CASE WHEN IFNULL(tanggal_dikembalikan, NOW()) > tanggal_kembali THEN 1 ELSE 0 END) as terlambat')
            )
            ->where('status_kembali', 'kembali');

        if ($tahun) {
            $query->whereYear('tanggal_pinjam', $tahun);
        }
        if ($bulan) {
            $query->whereMonth('tanggal_pinjam', $bulan);
        }

        $data = $query->groupBy('poli')->get();

        // Convert data ke array yang mudah diakses
        $dataAssoc = [];
        foreach ($data as $item) {
            $dataAssoc[$item->poli] = $item;
        }

        $finalData = [];
        foreach ($poliList as $poli) {
            if (isset($dataAssoc[$poli])) {
                $finalData[] = $dataAssoc[$poli];
            } else {
                // Poli tidak memiliki data, buat entri kosong
                $finalData[] = (object)[
                    'poli' => $poli,
                    'rekam_medis_keluar' => 0,
                    'rekam_medis_kembali_24' => 0,
                    'rekam_medis_kembali_24_plus' => 0,
                    'tepat_waktu' => 0,
                    'terlambat' => 0
                ];
            }
        }

        $data  = $finalData;

        $kepalaPuskesmas = User::where('role', "kepala puskesmas")->first();

        // Kembalikan data dan tampilkan di view untuk di-export ke PDF
        return view("pages.distribusi.pdf", compact('finalData', 'bulan', 'tahun', 'namaBulan', 'kepalaPuskesmas', 'data'));
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
