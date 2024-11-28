@extends('layouts.home')

@section('content')
    <div class="flex flex-col items-center justify-center   ">
        <h3 class="font-bold text-xl mb-6">Laporan Distribusi Rekam Medis Rawat Jalan</h3>
        <div class="bg-white rounded-md p-4 w-96 shadow-md">
            <form action="{{ route('rekam-medis.laporan.pdf', ['id' => 1]) }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                    <select id="bulan" name="bulan"
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

                <div class="mb-4">
                    <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                    <select id="tahun" name="tahun"
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

                <div class="flex justify-center w-full">
                    <button type="submit" class="bg-[#4d869c]  text-white px-4 py-2 rounded-md">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection
