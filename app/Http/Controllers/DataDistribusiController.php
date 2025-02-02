<?php

namespace App\Http\Controllers;

use App\Models\Klpcm;
use App\Models\KlpcmDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataDistribusiController extends Controller
{
    //

    public function index()
    {

        if (Auth::user()->role == 'petugas') {
            $klpcms = KlpcmDetail::with('klpcm')->where('tanggal_pinjam', Carbon::now()->toDateString())->where('status_lengkap', '<>', 'lengkap')->paginate(10);
        } else {
            $klpcms = KlpcmDetail::with('klpcm')->paginate(10);
        }

        $excludedAttributes = ['created_at', 'updated_at', 'id', 'klpcm_id'];

        foreach ($klpcms as $detail) {
            if ($detail) {
                $trueCount = 0;
                $totalCount = 14;
                $excludedAttributes = [
                    'created_at',
                    'updated_at',
                    'id',
                    'klpcm_id',
                    'status_kembali',
                    'status_lengkap',
                    'kode_wilayah',
                    'nama_string',
                    'keperluan',
                    'poli',
                    'nama_peminjam',
                    'tanggal_pinjam',
                    'tanggal_kembali',
                    'no_wa'
                ];
                $attributes = [];
                foreach ($detail->getAttributes() as $attribute => $value) {
                    if (!in_array($attribute, $excludedAttributes)) {
                        array_push($attributes, $attribute);
                    }
                }
                foreach ($attributes as $attribute => $value) {
                    $data = $detail->$value;
                    if ($data) {
                        $trueCount++;
                    }
                }
                $detail->true_percentage = number_format($totalCount > 0 ? ($trueCount / $totalCount) * 100 : 0, 2);
            } else {
                $detail->true_percentage = 0;
            }
        }
        if (auth()->user()->role == 'admin') {
            return view("pages.klpcm.index_for_admin", compact('klpcms'));
        }

        return view("pages.klpcm.index", compact('klpcms'));
    }


    public function updateStatusKembali(Request $request, $id)
    {
        $klpcm = KlpcmDetail::where('id', $id)->first();
        $klpcm->update(
            [
                'status_kembali' => $request->status,
                'tanggal_kembali' => Carbon::now()
            ]
        );
        return redirect()->back()->with('success', 'Berhasil memperbarui status kembali!');
    }

    public function edit($id)
    {
        $klpcm = Klpcm::findOrFail($id);
        return view("pages.klpcm.edit", compact('klpcm'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'no_rm' => 'required',
                'kode_wilayah' => 'required',
                'nama_string' => 'required',
                'keperluan' => 'required',
                'poli' => 'required',
                'nama_peminjam' => 'required',
                'tanggal_pinjam' => 'required|date',
                'tanggal_kembali' => 'required|date',
                'no_wa' => 'required|max:15, min:11'
            ]
        );



        $detail = Klpcm::findOrFail($id)->update([
            'no_rm' => $request->no_rm
        ]);


        $validated['klpcm_id'] = $id;
        unset($validated['no_rm']);


        KlpcmDetail::updateOrCreate(
            [
                'id' => $request->detail_id,
                'klpcm_id' => $id
            ],
            $validated
        );

        return redirect()->route('rekam-medis.index')->with('success', 'berhasil memperbarui data klpcm');
    }

    public function create()
    {
        return view("pages.distribusi.create");
    }

    public function destroy($id)
    {
        KlpcmDetail::findOrFail($id)->delete();
        return redirect()->route('distribusi.index')->with('success', 'berhasil menghapus data klpcm');
    }

    public function show($id)
    {
        $klpcm = KlpcmDetail::findOrFail($id);

        $detail = KlpcmDetail::findOrFail($id);


        $attributes = [
            'no_rm' => 'Nomor Rekam Medis',
            'nama' => 'Nama',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
            'umur' => 'Umur',
            'alamat' => 'Alamat',
            'pendidikan' => 'Pendidikan',
            'agama' => 'Agama',
            'diagnosa_utama' => 'Diagnosa Utama',
            'nama_terang' => 'Nama Terang',
            'tanda_tangan' => 'Tanda Tangan',
            'identifikasi' => 'Identifikasi',
            'diagnosis' => 'Diagnosis',
            'pembetulan_kesalahan' => 'Pembetulan Kesalahan',
        ];

        $missingFields = [];

        foreach ($attributes as $attribute => $label) {

            if ($detail->$attribute == 0) {
                $missingFields[] = $attribute;
            }
        }


        $pesan = '';


        if (count($missingFields) > 0) {
            $missingFieldsList = implode(', ', $missingFields);
            // Sistem Distribusi Rekam Medis dan KLPCM Puskesmas BWI Kota Baubau. Rekam Medis 0 atas nama ZAM tujuan poli umum BELUM KEMBALI/BELUM LENGKAP.
            $pesan = sprintf(
                'Sistem Distribusi Rekam Medis dan KLPCM Puskesmas BWI Kota Baubau Rekam medis %s atas nama %s tujuan poli %s %s. Segera lengkapi %s pada rekam medis pasien.',
                $detail->klpcm->no_rm,
                $detail->nama_string,
                'Umum', // Poli, bisa diubah sesuai kebutuhan
                'BELUM LENGKAP', // Status
                $missingFieldsList
            );
        }

        return view("pages.klpcm.periksa", compact('klpcm', 'pesan'));
    }


    public function updateStatusPemeriksaan(Request $request, $id)
    {
        $validated = $request->validate([
            'klpcm_id' => 'required|string|max:255',
            'no_rm' => 'required|boolean',
            'nama' => 'required|boolean',
            'jenis_kelamin' => 'required|boolean',
            'tanggal_lahir' => 'required|boolean',
            'umur' => 'required|boolean',
            'alamat' => 'required|boolean',
            'pendidikan' => 'required|boolean',
            'agama' => 'required|boolean',
            'diagnosa_utama' => 'required|boolean',
            'nama_terang' => 'required|boolean',
            'tanda_tangan' => 'required|boolean',
            'identifikasi' => 'required|boolean',
            'diagnosis' => 'required|boolean',
            'pembetulan_kesalahan' => 'required|boolean',
        ]);

        $detail = KlpcmDetail::findOrFail($id);

        $detail->update($validated);

        $allTrue = true;
        $fieldsToCheck = ['no_rm', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'umur', 'alamat', 'pendidikan', 'agama', 'diagnosa_utama', 'nama_terang', 'tanda_tangan', 'identifikasi', 'diagnosis', 'pembetulan_kesalahan'];

        foreach ($fieldsToCheck as $field) {
            if (!$detail->$field) {
                $allTrue = false;
                break;
            }
        }

        if ($allTrue) {
            KlpcmDetail::findOrFail($id)->update([
                'status_lengkap' => 'lengkap'
            ]);
        } else {
            KlpcmDetail::findOrFail($id)->update([
                'status_lengkap' => 'belum-lengkap'
            ]);
        }


        return back()->with('success', 'berhasil memperbarui kesetatusan pemeriksaan');
    }

    public function sendNotifikasiBelumLengkap(Request $request, $id)
    {
        try {
            //code...
            $detail = KlpcmDetail::findOrFail($id);



            $attributes = [

                'no_rm' => 'Nomor Rekam Medis',
                'nama' => 'Nama',
                'jenis_kelamin' => 'Jenis Kelamin',
                'tanggal_lahir' => 'Tanggal Lahir',
                'umur' => 'Umur',
                'alamat' => 'Alamat',
                'pendidikan' => 'Pendidikan',
                'agama' => 'Agama',
                'diagnosa_utama' => 'Diagnosa Utama',
                'nama_terang' => 'Nama Terang',
                'tanda_tangan' => 'Tanda Tangan',
                'identifikasi' => 'Identifikasi',
                'diagnosis' => 'Diagnosis',
                'pembetulan_kesalahan' => 'Pembetulan Kesalahan',
            ];

            $missingFields = [];

            foreach ($attributes as $attribute => $label) {
                if ($detail->$attribute == 0) {
                    $missingFields[] = $label;
                }
            }


            if (count($missingFields) > 0) {
                $missingFieldsList = implode(', ', $missingFields);
                $pesan = sprintf(
                    'Sistem Distribusi Rekam Medis dan KLPCM Puskesmas BWI Kota Baubau Rekam medis %s atas nama %s tujuan poli %s %s',
                    $detail->klpcm->no_rm,
                    $detail->nama_string,
                    $detail->poli,
                    'BELUM KEMBALI'
                );
            }

            $curl = curl_init();


            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $detail->no_wa,
                    'message' => $pesan,
                    'countryCode' => '62',
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: rA1esHJCqi4V9m9aTWnL'
                ),
            ));

            $response = curl_exec($curl);

            $responseJson = json_decode($response);
            if ($responseJson->status) {
                return back()->with('success', 'berhasil mengirim notifikasi!');
            }
            return back()->withErrors('gagal mengirim notifikasi' . $responseJson->detail);
        } catch (\Throwable $th) {
            //throw $th;
            return back()->withErrors($th->getMessage());
        }
    }


    public function sendNotifikasi(Request $request, $id)
    {
        try {
            //code...
            $detail = KlpcmDetail::findOrFail($id);


            $attributes = [
                'no_rm' => 'Nomor Rekam Medis',
                'nama' => 'Nama',
                'jenis_kelamin' => 'Jenis Kelamin',
                'tanggal_lahir' => 'Tanggal Lahir',
                'umur' => 'Umur',
                'alamat' => 'Alamat',
                'pendidikan' => 'Pendidikan',
                'agama' => 'Agama',
                'diagnosa_utama' => 'Diagnosa Utama',
                'nama_terang' => 'Nama Terang',
                'tanda_tangan' => 'Tanda Tangan',
                'identifikasi' => 'Identifikasi',
                'diagnosis' => 'Diagnosis',
                'pembetulan_kesalahan' => 'Pembetulan Kesalahan',
            ];

            $missingFields = [];

            foreach ($attributes as $attribute => $label) {

                if ($detail->$attribute == 0) {
                    $missingFields[] = $attribute;
                }
            }


            if (count($missingFields) > 0) {
                $missingFieldsList = implode(', ', $missingFields);
                // Sistem Distribusi Rekam Medis dan KLPCM Puskesmas BWI Kota Baubau. Rekam Medis 0 atas nama ZAM tujuan poli umum BELUM KEMBALI/BELUM LENGKAP.
                $pesan = sprintf(
                    'Sistem Distribusi Rekam Medis dan KLPCM Puskesmas BWI Kota Baubau Rekam medis %s atas nama %s tujuan poli %s %s. Segera lengkapi %s pada rekam medis pasien.',
                    $detail->klpcm->no_rm,
                    $detail->nama_string,
                    $detail->poli, // Poli, bisa diubah sesuai kebutuhan
                    'BELUM LENGKAP', // Status
                    $missingFieldsList
                );
            }

            $curl = curl_init();


            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $detail->no_wa,
                    'message' => $pesan,
                    'countryCode' => '62',
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: rA1esHJCqi4V9m9aTWnL'
                ),
            ));

            $response = curl_exec($curl);

            $responseJson = json_decode($response);
            if ($responseJson->status) {
                return back()->with('success', 'berhasil mengirim notifikasi!');
            }
            return back()->withErrors('gagal mengirim notifikasi' . $responseJson);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return back()->withErrors($th->getMessage());
        }
    }


    public function laporan(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $namaBulan = $bulan ? $this->getNamaBulan($bulan) : null;

        $data = DB::table('klpcm_detail')
            ->select(
                'poli',
                DB::raw('COUNT(*) as rekam_medis_total'),
                DB::raw('SUM(CASE WHEN status_lengkap = "lengkap" THEN 1 ELSE 0 END) as rekam_medis_lengkap'),
                DB::raw('SUM(CASE WHEN status_lengkap = "belum-lengkap" THEN 1 ELSE 0 END) as rekam_medis_belum_lengkap'),
                DB::raw('ROUND(SUM(CASE WHEN status_lengkap = "lengkap" THEN 1 ELSE 0 END) / COUNT(*) * 100, 2) as persen_lengkap'),
                DB::raw('ROUND(SUM(CASE WHEN status_lengkap = "belum-lengkap" THEN 1 ELSE 0 END) / COUNT(*) * 100, 2) as persen_belum_lengkap')
            )
            ->when($bulan, function ($query, $bulan) {
                $query->whereMonth('tanggal_pinjam', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                $query->whereYear('tanggal_pinjam', $tahun);
            })
            ->groupBy('poli')
            ->get()
            ->toArray();
        return view("pages.klpcm.laporan", compact('data'));
    }


    public function laporanExport(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $namaBulan = $this->getNamaBulan($bulan);

        $data = DB::table('klpcm_detail')
            ->select(
                'poli',
                DB::raw('COUNT(*) as rekam_medis_total'),
                DB::raw('SUM(CASE WHEN status_lengkap = "lengkap" THEN 1 ELSE 0 END) as rekam_medis_lengkap'),
                DB::raw('SUM(CASE WHEN status_lengkap = "belum-lengkap" THEN 1 ELSE 0 END) as rekam_medis_belum_lengkap'),
                DB::raw('ROUND(SUM(CASE WHEN status_lengkap = "lengkap" THEN 1 ELSE 0 END) / COUNT(*) * 100, 2) as persen_lengkap'),
                DB::raw('ROUND(SUM(CASE WHEN status_lengkap = "belum-lengkap" THEN 1 ELSE 0 END) / COUNT(*) * 100, 2) as persen_belum_lengkap')
            )
            ->whereMonth('tanggal_pinjam', $bulan)
            ->whereYear('tanggal_pinjam', $tahun)
            ->groupBy('poli')
            ->get()->toArray();

        return view("pages.klpcm.pdf", compact('data', 'tahun', 'namaBulan'));
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
