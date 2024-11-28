<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Distribusi Rekam Medis Rawat Jalan</title>
    @vite('resources/css/app.css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="p-10">
    <div class="text-center mb-8">
        <img src="{{ asset('/images/logo-rekam-medis.jpeg') }}" alt="Puskesmas Logo" class="w-16 h-16 mb-4">
        <h1 class="font-bold text-xl">PUSKESMAS BUKIT WOLIO INDAH</h1>
        <p>Jl. Poros BTN Medibrata, Bukit Wolio Indah</p>
        <p>Kec. Wolio, Kota BauBau, Sulawesi Tenggara</p>
        <p>Telp. (0402) 2828144, email : puskesmasbukitwolioindah@gmail.com</p>
    </div>

    <div class="text-center mb-4">
        <h2 class="font-bold text-lg">LAPORAN DISTRIBUSI REKAM MEDIS RAWAT JALAN</h2>
        <p>Bulan: {{ $namaBulan }}</p>
        <p>Tahun: {{ $tahun }}</p>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Poliklinik</th>
                <th class="border border-gray-300 px-4 py-2">Rekam Medis Keluar</th>
                <th class="border border-gray-300 px-4 py-2">Rekam Medis Kembali < 24 jam</th>
                <th class="border border-gray-300 px-4 py-2">Rekam Medis Kembali > 24 jam</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $row)
                <tr>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $row->poli }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $row->rekam_medis_keluar }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $row->rekam_medis_kembali_24 }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $row->rekam_medis_kembali_24_plus }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>
