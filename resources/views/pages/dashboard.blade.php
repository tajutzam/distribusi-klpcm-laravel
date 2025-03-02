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
            {{-- <h2>Rekam Medis Kembali Tepat Waktu={{ $rekamMedisKembaliTepatWaktu }}, Rekam Medis Terlambat
                {{ $rekamMedisKembaliTerlambat }}
            </h2> --}}
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
            {{-- <h2>Rekam Medis Lengkap = ={{ number_format($persenLengkap, 1) }} %, Rekam Medis belum lengkap = --}}
            {{-- {{ number_format($persenTidakLengkap, 1) }} % --}}
            {{-- </h2> --}}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Ambil data dari controller
        const distribusiData = {!! json_encode($distribusiPerPoli) !!};
        const kelengkapanData = {!! json_encode($kelengkapanPerPoli) !!};

        // Grafik Distribusi
        const ctxDistribusi = document.getElementById('grafikDistribusi').getContext('2d');
        new Chart(ctxDistribusi, {
            type: 'bar',
            data: {
                labels: distribusiData.map(item => item.poli),
                datasets: [{
                        label: 'Tepat Waktu',
                        data: distribusiData.map(item => item.tepat_waktu),
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Terlambat',
                        data: distribusiData.map(item => item.terlambat),
                        backgroundColor: 'rgba(255, 159, 64, 0.6)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }
                ]
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

        // Grafik Kelengkapan
        const ctxKelengkapan = document.getElementById('grafikKelengkapan').getContext('2d');
        new Chart(ctxKelengkapan, {
            type: 'bar',
            data: {
                labels: kelengkapanData.map(item => item.poli),
                datasets: [{
                        label: 'Lengkap (%)',
                        data: kelengkapanData.map(item => item.persen_lengkap),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Tidak Lengkap (%)',
                        data: kelengkapanData.map(item => item.persen_tidak_lengkap),
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
