@extends('layouts.home')

@section('content')
    <h3 class="flex justify-center text-3xl font-bold">Selamat datang
        <span class="uppercase mx-10">
            &nbsp;{{ auth()->user()->name }}&nbsp;
        </span>
        Di De-KLPCM
    </h3>

    <!-- Grafik Distribusi -->
    <div class="flex w-full overflow-x-auto" style="margin-top: 20px;">
        <div class="mt-10 w-full lg:w-1/2 px-2">
            <h4 class="text-xl font-bold text-center mb-4 uppercase">
                Grafik Distribusi Rekam Medis <br>
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('F') }}
            </h4>
            <div class="flex justify-center">
                <canvas id="grafikDistribusi" width="800" height="400"></canvas>
            </div>
            <h2>Rekam Medis Kembali < 24 jam={{ $rekamMedis24Jam }}, Rekam Medis Kembali> 24 jam {{ $rekamMedis24PlusJam }}
            </h2>
        </div>

        <!-- Grafik Kelengkapan -->
        <div class="mt-10 w-full lg:w-1/2 px-2">
            <h4 class="text-xl font-bold text-center mb-4 uppercase">
                Grafik Kelengkapan Rekam Medis <br>
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('F') }}
            </h4>
            <div class="flex justify-center">
                <canvas id="grafikKelengkapan" width="800" height="400"></canvas>
            </div>
            <h2>Rekam Medis Lengkap = ={{ number_format($persenLengkap, 1) }} %, Rekam Medis belum lengkap =
                {{ number_format($persenTidakLengkap, 1) }} %
            </h2>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Tambahkan Chart.js dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Grafik Distribusi (hanya 2 bar: < 24 Jam, > 24 Jam)
        const ctxDistribusi = document.getElementById('grafikDistribusi').getContext('2d');
        const grafikDistribusi = new Chart(ctxDistribusi, {
            type: 'bar',
            data: {
                labels: ['< 24 Jam', '> 24 Jam'], // Kategori
                datasets: [{
                    label: 'Jumlah Rekam Medis',
                    data: [{{ $rekamMedis24Jam }},
                        {{ $rekamMedis24PlusJam }}
                    ], // Data jumlah < 24 jam dan > 24 jam
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Grafik Kelengkapan (hanya 2 bar: Lengkap, Tidak Lengkap)
        const ctxKelengkapan = document.getElementById('grafikKelengkapan').getContext('2d');
        const grafikKelengkapan = new Chart(ctxKelengkapan, {
            type: 'bar',
            data: {
                labels: ['Lengkap', 'Tidak Lengkap'], // Kategori
                datasets: [{
                    label: 'Jumlah Rekam Medis',
                    data: [{{ $persenLengkap }},
                        {{ $persenTidakLengkap }}
                    ], // Data jumlah lengkap dan tidak lengkap
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)', // Lengkap
                        'rgba(255, 99, 132, 0.6)' // Tidak Lengkap
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)', // Lengkap
                        'rgba(255, 99, 132, 1)' // Tidak Lengkap
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
