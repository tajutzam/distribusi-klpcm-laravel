@extends('layouts.home')

@section('content')
    <div class="flex justify-center items-center min-h-screen">
        <section class="bg-white px-4 py-4 rounded-lg w-full max-w-lg">
            <x-alert />
            <form action="{{ route('perawat.update', ['perawat' => $perawat->id]) }}" class="w-full" method="POST">
                @csrf
                @method('put')
                <div class="flex flex-wrap -mx-3 mb-6">
                    <!-- NIP Field -->
                    <div class="w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nip">
                            NIP
                        </label>
                        <input name="nip" value="{{ old('nip', $perawat->nip) }}"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="nip" type="text" placeholder="Enter NIP">
                    </div>
                    <!-- Name Field -->
                    <div class="w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            Nama
                        </label>
                        <input name="name" value="{{ old('name', $perawat->name) }}"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="name" type="text" placeholder="Enter Name">
                    </div>


                    <div class="w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            No WhatshApp
                        </label>
                        <input name="no_wa" value="{{ old('no_wa', $perawat->no_wa) }}"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="name" type="text" placeholder="Enter No Wa">
                    </div>
                    <!-- Access Field -->
                    <div class="w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="access">
                            Poly
                        </label>
                        <div class="relative">
                            <select name="poly"
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="access">
                                <option {{ $perawat->poly == 'POLI UMUM' ? 'selected' : '' }} value="POLI UMUM">Poli Umum
                                </option>
                                <option {{ $perawat->poly == 'POLI GIGI' ? 'selected' : '' }} value="POLI GIGI">Poli Gigi
                                </option>
                                <option {{ $perawat->poly == 'POLI KIA/KB' ? 'selected' : '' }} value="POLI KIA/KB">Poli
                                    KIA/KB</option>
                                <option {{ $perawat->poly == 'POLI MTBS' ? 'selected' : '' }} value="POLI MTBS">Poli MTBS
                                </option>
                            </select>

                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="flex justify-center">
                    <button type="submit"
                        class="px-4 py-2 bg-[#4d869c] rounded-md text-white hover:bg-[#2d5261]">Simpan</button>
                </div>
            </form>
        </section>
    </div>
    <a href="{{ url()->previous() }}" class="px-4 py-2 bg-[#4d869c] rounded-md text-white hover:bg-[#2d5261]">Kembali</a>
@endsection
