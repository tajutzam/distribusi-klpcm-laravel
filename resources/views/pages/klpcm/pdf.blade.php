<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kelengkapan Pencatatan Rekam Medis Rawat Jalan</title>
    @vite('resources/css/app.css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-white text-black">
    <div class="container mx-auto p-8">
        <div class="text-center mb-8">
            <img src="{{ asset('/images/logo-rekam-medis.jpeg') }}" alt="Puskesmas Logo" class="w-16 h-16 mb-4">
            <h2 class="text-lg font-bold">PUSKESMAS BUKIT WOLIO INDAH</h2>
            <p>Jl. Poros BTN Medibrata, Bukit Wolio Indah, Kec.Wolio, Kota BauBau, Sulawesi Tenggara</p>
            <p>Telp. (0402) 2828144 , email : puskesmasbukitwoliondah@gmail.com</p>
        </div>

        <div class="border-t border-b py-4">
            <h3 class="text-center text-lg font-bold">LAPORAN KELENGKAPAN PENCATATAN REKAM MEDIS RAWAT JALAN</h3>
            <p class="text-center">Bulan : {{ $namaBulan }}</p>
            <p class="text-center">Tahun : {{ $tahun }}</p>
        </div>

        <table class="table-auto w-full mt-8 border">
            <thead>
                <tr class="bg-gray-200 text-center">
                    <th rowspan="2" class="px-4 py-2 border">No</th>
                    <th rowspan="2" class="px-4 py-2 border">Poliklinik</th>
                    <th rowspan="2" class="px-4 py-2 border">Rekam Medis</th>
                    <th colspan="2" class="px-4 py-2 border">Lengkap</th>
                    <th colspan="2" class="px-4 py-2 border">Belum Lengkap</th>
                </tr>
                <tr class="bg-gray-200 text-center">
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">%</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">%</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $row)
                    <tr>
                        <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ $row->poli }}</td>
                        <td class="px-4 py-2 border text-center">{{ $row->rekam_medis_total }}</td>
                        <td class="px-4 py-2 border text-center">{{ $row->rekam_medis_lengkap }}</td>
                        <td class="px-4 py-2 border text-center">{{ $row->persen_lengkap }}%</td>
                        <td class="px-4 py-2 border text-center">{{ $row->rekam_medis_belum_lengkap }}</td>
                        <td class="px-4 py-2 border text-center">{{ $row->persen_belum_lengkap }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex mt-4 justify-end">
            Baubau, {{ Carbon\Carbon::now()->format('d, F Y') }}
        </div>
        <br><br><br>
        <div class="flex justify-end">
            <div class="flex justify-center flex-col items-center">
                <h2 class="underline">&nbsp&nbsp {{ $kepalaPuskesmas->name }}</h2>
                <h2>NIP : {{ $kepalaPuskesmas->nip }}</h2>
            </div>
        </div>

    </div>
    <script>
        window.print();
    </script>
</body>

</html>
