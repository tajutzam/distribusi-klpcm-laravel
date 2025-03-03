@extends('layouts.home')

@section('content')
    <div class="flex flex-col items-center justify-center   ">
        <h3 class="font-bold text-xl mb-6">Laporan Kelengkapan Pencatatan Rekam Medis Rawat Jalan</h3>
        <div class="bg-white rounded-md p-4 shadow-md w-full">
            <form action="{{ route('data-distribusi.laporan-pdf') }}" method="post">
                @csrf
                <div class="flex gap-4 items-center">
                    <div class="mb-4" style="width: 200px;">
                        <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                        <select id="bulan" name="bulan" required
                            class="mt-1 block py-2 px-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Pilih Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>

                    <div class="mb-4" style="width: 200px">
                        <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                        <select id="tahun" name="tahun" required
                            class="mt-1 block w-full py-2 px-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Pilih Tahun</option>
                            <!-- Daftar tahun mulai dari 2020 hingga 2030 -->
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>
                    </div>
                    <div class="flex gap-4 justify-between w-full">
                        <!-- Kirim Button -->
                        <div>
                            <button type="submit" formaction="{{ url()->current() }}" formmethod="get"
                                class="bg-[#4d869c] text-white px-4 py-2 rounded-md">
                                Tampil
                            </button>
                        </div>

                        <!-- PDF Button -->
                        <div>
                            <button type="submit" class="bg-[#4d869c] text-white px-4 py-2 rounded-md">
                                PDF
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Buttons -->
            </form>
        </div>


        <div class="bg-white mt-2 shadow-lg container overflow-x-auto">
            <table class="w-full border-collapse border  rounded-md shadow-md">
                <thead>
                    <tr class="bg-gray-600  text-left font-medium text-white">
                        <th rowspan="2" class="px-4 py-2 border">No</th>
                        <th rowspan="2" class="px-4 py-2 border">Poliklinik</th>
                        <th rowspan="2" class="px-4 py-2 border">Rekam Medis</th>
                        <th colspan="2" class="px-4 py-2 border">Lengkap</th>
                        <th colspan="2" class="px-4 py-2 border">Belum Lengkap</th>
                    </tr>
                    <tr class="bg-gray-600  text-left font-medium text-white">
                        <th class="px-4 py-2 border">Jumlah</th>
                        <th class="px-4 py-2 border">%</th>
                        <th class="px-4 py-2 border">Jumlah</th>
                        <th class="px-4 py-2 border">%</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $row)
                        <tr>
                            <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
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
        </div>

    </div>
@endsection
