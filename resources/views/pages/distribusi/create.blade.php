@extends('layouts.home')

@section('content')
    <form action="{{ route('rekam-medis.store') }}" method="post">
        @csrf
        <div class="flex flex-col md:flex-row gap-3">
            <!-- Card 1 -->
            <div class="bg-white p-7 shadow-lg rounded-lg w-full">
                <h1 class="text-xl font-bold mb-4 text-center">Data Peminjaman</h1>
                <!-- Input Fields Row 1 -->
                <div class="flex flex-col md:flex-row justify-between gap-2">
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input1">
                            Nomor Rekam Medis <span class="text-red-500">*</span>
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="input1" type="text" value="{{ old('no_rm') }}" name="no_rm"
                            placeholder="Enter text">
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input2">
                            Kode Wilayah <span class="text-red-500">*</span>
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="input2" type="text" value="{{ old('kode_wilayah') }}" name="kode_wilayah"
                            placeholder="Enter text">
                    </div>
                </div>
                <!-- Input Fields Row 2 -->
                <div class="flex flex-col md:flex-row justify-between gap-2">
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input3">
                            Nama <span class="text-red-500">*</span>
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="input3" type="text" value="{{ old('nama') }}" name="nama_string"
                            placeholder="Enter text">
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input4">
                            Keperluan <span class="text-red-500">*</span>
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="input4" type="text" value="{{ old('keperluan') }}" name="keperluan"
                            placeholder="Enter text">
                    </div>
                </div>
                <!-- Input Fields Row 3 -->
                <div class="flex flex-col md:flex-row justify-between gap-2">
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input5">
                            Poli <span class="text-red-500">*</span>
                        </label>
                        <select name="poli"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="input5">
                            <option value="" disabled selected>Pilih Poli</option>
                            <option value="Poli Umum">Poli Umum</option>
                            <option value="Poli Gigi">Poli Gigi</option>
                            <option value="KIA/KB">KIA/KB</option>
                            <option value="Poli MTBS">Poli MTBS</option>
                        </select>
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input6">
                            Nama Peminjam <span class="text-red-500">*</span>
                        </label>
                        <input name="nama_peminjam"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="input6" type="text" value="{{ old('nama_peminjam') }}" placeholder="Enter text">
                    </div>
                </div>
                <div class="mb-4 w-full">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="input6">
                        Nomor Whatsapp Peminjam <span class="text-red-500">*</span>
                    </label>
                    <input name="no_wa"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="input6" type="text" value="{{ old('nama_peminjam') }}" placeholder="Enter text">
                </div>

            </div>

            <!-- Card 2 -->
            <div class="bg-white p-7 shadow-lg rounded-lg w-full">
                <div class="flex flex-col md:flex-row justify-between gap-2">
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input7">
                            Tanggal Pinjam <span class="text-red-500">*</span>
                        </label>
                        <input name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="input7" type="date" placeholder="Enter text">
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input8">
                            Tanggal Kembali <span class="text-red-500">*</span>
                        </label>
                        <input name="tanggal_kembali" value="{{ old('tanggal_kembali') }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="input8" type="date" placeholder="Enter text">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4 md:mt-0 w-full md:w-auto"
                        type="submit">
                        Submit
                        <i class="fa-solid fa-paper-plane" style="color: #ffffff;"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
