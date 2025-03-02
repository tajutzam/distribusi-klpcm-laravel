@extends('layouts.home')

@section('content')
    <div class="flex flex-col items-center justify-center   ">
        <h3 class="font-bold text-xl mb-6">Laporan Distribusi Rekam Medis Rawat Jalan</h3>
        <div class="bg-white rounded-md p-4 w-full shadow-md">
            <form action="{{ route('rekam-medis.laporan.pdf', ['id' => 1]) }}" method="post">
                @csrf
                <div class="flex gap-6">
                    <!-- Input Bulan -->
                    <div class="mb-4 " style="width: 400px">
                        <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                        <select id="bulan" name="bulan"
                            class="mt-1 block py-2 px-1 w-full border-black rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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

                    <!-- Input Tahun -->
                    <div class="mb-4">
                        <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                        <select id="tahun" name="tahun"
                            class="mt-1 block w-full py-2 px-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Pilih Tahun</option>
                            <!-- Tahun Options -->
                            @for ($i = 2020; $i <= 2030; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 justify-end">
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
            </form>

        </div>
        <div class="bg-white mt-2 shadow-lg container overflow-x-auto">
            <table class="w-full border-collapse border  rounded-md shadow-md">
                <thead>
                    <tr class="bg-gray-600  text-left font-medium text-white">
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Poliklinik</th>
                        <th class="border border-gray-300 px-4 py-2">Rekam Medis Keluar</th>
                        <th class="border border-gray-300 px-4 py-2">Rekam Medis Kembali Tepat Waktu (≤ 24 Jam)</th>
                        <th class="border border-gray-300 px-4 py-2">Rekam Medis Kembali Terlambat (≥ 24 Jam)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $row)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $row->poli }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $row->rekam_medis_keluar }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $row->tepat_waktu }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $row->terlambat }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
