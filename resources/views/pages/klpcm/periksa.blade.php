@extends('layouts.without-navbar')
<style>
    label {
        font-size: 18px
    }
</style>
{{-- @dd($klpcm->detail) --}}
@section('content')
    <a href="{{ route('distribusi.index') }}" class="bg-blue-500 px-4 py-2 rounded text-white hover:bg-blue-800">Kembali</a>

    <div class="header text-center mb-5">
        <h2 class="text-xl font-bold">Cek Ketidaklengkapan <br> Pencatatan Catatan Medis</h2>
        <h2 class="text-xl font-bold mt-5">Kartu Rawat Jalan</h2>
    </div>
    <form action="{{ route('data-distribusi.update.status.pemeriksaan', ['id' => $klpcm->id]) }}" method="post">
        @method('put')
        @csrf
        <div class="bg-white px-2 py-1 shadow-lg rounded-lg w-full mt-1">
            <h2 class="text-xl font-bold text-center mb-5">IDENTIFIKASI</h2>
            <div class="grid gap-5 md:grid-cols-2 sm:grid-cols-1">
                <input type="text" name="klpcm_id" hidden value="{{ $klpcm->klpcm_id }}">
                <div>
                    {{-- No RM --}}
                    <div class="mb-1">
                        <div class="flex items-center space-x-4">
                            <label for="no-rm" class="font-bold mb-1 w-24">No RM</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="lengkap-no-rm" name="no_rm" value="1"
                                    {{ old('no_rm', $klpcm->no_rm) == 1 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="lengkap-no-rm" class="text-gray-700">Lengkap</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="tidak-lengkap-no-rm" name="no_rm" value="0"
                                    {{ old('no_rm', $klpcm->no_rm) == 0 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="tidak-lengkap-no-rm" class="text-gray-700">Tidak Lengkap</label>
                            </div>
                        </div>
                    </div>

                    {{-- Nama --}}
                    <div class="mb-1">
                        <div class="flex items-center space-x-4">
                            <label for="nama" class="font-bold mb-1 w-24">Nama</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="lengkap-nama" name="nama" value="1"
                                    {{ old('nama', $klpcm->nama) == 1 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="lengkap-nama" class="text-gray-700">Lengkap</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="tidak-lengkap-nama" name="nama" value="0"
                                    {{ old('nama', $klpcm->nama) == 0 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="tidak-lengkap-nama" class="text-gray-700">Tidak Lengkap</label>
                            </div>
                        </div>
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-1">
                        <div class="flex items-center space-x-4">
                            <label for="jenis_kelamin" class="font-bold mb-1 w-24">Jenis Kelamin</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="lengkap-jenis-kelamin" name="jenis_kelamin" value="1"
                                    {{ old('jenis_kelamin', $klpcm->jenis_kelamin) == 1 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="lengkap-jenis-kelamin" class="text-gray-700">Lengkap</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="tidak-lengkap-jenis-kelamin" name="jenis_kelamin" value="0"
                                    {{ old('jenis_kelamin', $klpcm->jenis_kelamin) == 0 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="tidak-lengkap-jenis-kelamin" class="text-gray-700">Tidak Lengkap</label>
                            </div>
                        </div>
                    </div>

                    {{-- Tgl. Lahir --}}
                    <div class="mb-1">
                        <div class="flex items-center space-x-4">
                            <label for="tgl-lahir" class="font-bold mb-1 w-24">Tgl. Lahir</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="lengkap-tgl-lahir" name="tanggal_lahir" value="1"
                                    {{ old('tanggal_lahir', $klpcm->tanggal_lahir) == 1 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="lengkap-tgl-lahir" class="text-gray-700">Lengkap</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="tidak-lengkap-tgl-lahir" name="tanggal_lahir" value="0"
                                    {{ old('tanggal_lahir', $klpcm->tanggal_lahir) == 0 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="tidak-lengkap-tgl-lahir" class="text-gray-700">Tidak Lengkap</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    {{-- Umur --}}
                    <div class="mb-1">
                        <div class="flex items-center space-x-4">
                            <label for="umur" class="font-bold mb-1 w-24">Umur</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="lengkap-umur" name="umur" value="1"
                                    {{ old('umur', $klpcm->umur) == 1 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="lengkap-umur" class="text-gray-700">Lengkap</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="tidak-lengkap-umur" name="umur" value="0"
                                    {{ old('umur', $klpcm->umur) == 0 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="tidak-lengkap-umur" class="text-gray-700">Tidak Lengkap</label>
                            </div>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-1">
                        <div class="flex items-center space-x-4">
                            <label for="alamat" class="font-bold mb-1 w-24">Alamat</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="lengkap-alamat" name="alamat" value="1"
                                    {{ old('alamat', $klpcm->alamat) == 1 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="lengkap-alamat" class="text-gray-700">Lengkap</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="tidak-lengkap-alamat" name="alamat" value="0"
                                    {{ old('alamat', $klpcm->alamat) == 0 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="tidak-lengkap-alamat" class="text-gray-700">Tidak Lengkap</label>
                            </div>
                        </div>
                    </div>

                    {{-- Pendidikan --}}
                    <div class="mb-1">
                        <div class="flex items-center space-x-4">
                            <label for="pendidikan" class="font-bold mb-1 w-24">Pendidikan</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="lengkap-pendidikan" name="pendidikan" value="1"
                                    {{ old('pendidikan', $klpcm->pendidikan) == 1 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="lengkap-pendidikan" class="text-gray-700">Lengkap</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="tidak-lengkap-pendidikan" name="pendidikan" value="0"
                                    {{ old('pendidikan', $klpcm->pendidikan) == 0 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="tidak-lengkap-pendidikan" class="text-gray-700">Tidak Lengkap</label>
                            </div>
                        </div>
                    </div>

                    {{-- Agama --}}
                    <div class="mb-1">
                        <div class="flex items-center space-x-4">
                            <label for="agama" class="font-bold mb-1 w-24">Agama</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="lengkap-agama" name="agama" value="1"
                                    {{ old('agama', $klpcm->agama) == 1 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="lengkap-agama" class="text-gray-700">Lengkap</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="tidak-lengkap-agama" name="agama" value="0"
                                    {{ old('agama', $klpcm->agama) == 0 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="tidak-lengkap-agama" class="text-gray-700">Tidak Lengkap</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- laporan yang penting --}}

        <div class="bg-white px-2 py-1 shadow-lg rounded-lg w-full mt-1">
            <h2 class="text-xl font-bold text-center mb-5">LAPORAN YANG PENTING</h2>
            <div class="grid gap-5 md:grid-cols-2 sm:grid-cols-1">
                <div>
                    {{-- No RM --}}
                    <div class="mb-1">
                        <div class="flex items-center space-x-4">
                            <label for="no-rm" class="font-bold mb-1 md:w-40 sm:w-20">Diagnosa Utama</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="lengkap-no-rm" name="diagnosa_utama" value="1"
                                    {{ old('diagnosa_utama', $klpcm->diagnosa_utama) == 1 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="lengkap-no-rm" class="text-gray-700">Lengkap</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="tidak-lengkap-no-rm" name="diagnosa_utama" value="0"
                                    {{ old('diagnosa_utama', $klpcm->diagnosa_utama) == 0 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="tidak-lengkap-no-rm" class="text-gray-700">Tidak Lengkap</label>
                            </div>
                        </div>
                    </div>


                    @if ($klpcm->poli == 'Poli Gigi')
                        <div class="mb-1">
                            <div class="flex items-center space-x-4">
                                <label for="odontogram-lengkap" class="font-bold mb-1 md:w-40 sm:w-20">Odontogram</label>

                                <!-- Lengkap -->
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="odontogram-lengkap" name="odontogram" value="1"
                                        {{ old('odontogram', $klpcm->odontogram) == 1 ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                    <label for="odontogram-lengkap" class="text-gray-700">Lengkap</label>
                                </div>

                                <!-- Tidak Lengkap -->
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="odontogram-tidak-lengkap" name="odontogram" value="0"
                                        {{ old('odontogram', $klpcm->odontogram) == 0 ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                    <label for="odontogram-tidak-lengkap" class="text-gray-700">Tidak Lengkap</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1">
                            <div class="flex items-center space-x-4">
                                <label for="no-rm" class="font-bold mb-1 md:w-40 sm:w-20">Pemeriksaan Fisik</label>
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="lengkap-no-rm" name="pemeriksaan_fisik" value="1"
                                        {{ old('pemeriksaan_fisik', $klpcm->pemeriksaan_fisik) == 1 ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                    <label for="lengkap-no-rm" class="text-gray-700">Lengkap</label>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="tidak-lengkap-no-rm" name="pemeriksaan_fisik"
                                        value="0"
                                        {{ old('pemeriksaan_fisik', $klpcm->pemeriksaan_fisik) == 0 ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                    <label for="tidak-lengkap-no-rm" class="text-gray-700">Tidak Lengkap</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="flex items-center space-x-4">
                                <label for="no-rm" class="font-bold mb-1 md:w-40 sm:w-20">Perawatan Gigi</label>
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="pemeriksaan-gigi-lengkap" name="perawatan_gigi"
                                        value="1"
                                        {{ old('perawatan_gigi', $klpcm->perawatan_gigi) == 1 ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                    <label for="pemeriksaan-gigi-lengkap" class="text-gray-700">Lengkap</label>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="pemeriksaan-gigi-tidak-lengkap" name="perawatan_gigi"
                                        value="0"
                                        {{ old('perawatan_gigi', $klpcm->perawatan_gigi) == 0 ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                    <label for="pemeriksaan-gigi-tidak-lengkap" class="text-gray-700">Tidak
                                        Lengkap</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="flex items-center space-x-4">
                                <label for="no-rm" class="font-bold mb-1 md:w-40 sm:w-20">Informed consent</label>

                                <!-- Lengkap -->
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="informed-lengkap" name="informed_consent_penting"
                                        value="1"
                                        {{ old('informed_consent_penting', $klpcm->informed_consent_penting) == 1 ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                    <label for="informed-lengkap" class="text-gray-700">Lengkap</label>
                                </div>

                                <!-- Tidak Lengkap -->
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="informed-tidak-lengkap" name="informed_consent_penting"
                                        value="0"
                                        {{ old('informed_consent_penting', $klpcm->informed_consent_penting) == 0 ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                    <label for="informed-tidak-lengkap" class="text-gray-700">Tidak Lengkap</label>
                                </div>

                                <!-- Tidak Ada -->
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="informed-tidak-ada" name="informed_consent_penting"
                                        value=""
                                        {{ old('informed_consent_penting', $klpcm->informed_consent_penting) === null ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                    <label for="informed-tidak-ada" class="text-gray-700">Tidak Ada</label>
                                </div>
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- authentikasi --}}

        <div class="bg-white px-2 py-1 shadow-lg rounded-lg w-full mt-1">
            <h2 class="text-xl font-bold text-center mb-5">AUTENTIKASI (Tanda tangan dan Nama terang)</h2>
            <div class="grid gap-5 md:grid-cols-2 sm:grid-cols-1">
                <div>
                    {{-- No RM --}}
                    <div class="mb-1">
                        <div class="flex items-center space-x-4">
                            <label for="no-rm" class="font-bold mb-1 md:w-40 sm:w-20">Kartu Rawat Jalan</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="lengkap-no-rm" name="nama_terang" value="1"
                                    {{ old('nama_terang', $klpcm->nama_terang) == 1 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="lengkap-no-rm" class="text-gray-700">Lengkap</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="tidak-lengkap-no-rm" name="nama_terang" value="0"
                                    {{ old('nama_terang', $klpcm->nama_terang) == 0 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="tidak-lengkap-no-rm" class="text-gray-700">Tidak Lengkap</label>
                            </div>
                        </div>
                    </div>

                    @if ($klpcm->poli == 'Poli Gigi')
                        <div class="mb-1">
                            <div class="flex items-center space-x-4">
                                <label for="odontogram-auth-lengkap"
                                    class="font-bold mb-1 md:w-40 sm:w-20">Odontogram</label>

                                <!-- Lengkap -->
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="odontogram-auth-lengkap" name="odontogram_autentikasi"
                                        value="1"
                                        {{ old('odontogram_autentikasi', $klpcm->odontogram_autentikasi) == 1 ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                    <label for="odontogram-auth-lengkap" class="text-gray-700">Lengkap</label>
                                </div>

                                <!-- Tidak Lengkap -->
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="odontogram-auth-tidak-lengkap"
                                        name="odontogram_autentikasi" value="0"
                                        {{ old('odontogram_autentikasi', $klpcm->odontogram_autentikasi) == 0 ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                    <label for="odontogram-auth-tidak-lengkap" class="text-gray-700">Tidak Lengkap</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1">
                            <div class="flex items-center space-x-4">
                                <label for="no-rm" class="font-bold mb-1 md:w-40 sm:w-20">Informed consent</label>
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="lengkap-no-rm" name="informed_consent_autentikasi"
                                        value="1"
                                        {{ old('informed_consent_autentikasi', $klpcm->informed_consent_autentikasi) == 1 ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                    <label for="lengkap-no-rm" class="text-gray-700">Lengkap</label>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="tidak-lengkap-no-rm" name="informed_consent_autentikasi"
                                        value="0"
                                        {{ old('informed_consent_autentikasi', $klpcm->informed_consent_autentikasi) == 0 ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                    <label for="tidak-lengkap-no-rm" class="text-gray-700">Tidak Lengkap</label>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="tidak-lengkap-no-rm" name="informed_consent_autentikasi"
                                        value=""
                                        {{ old('informed_consent_autentikasi', $klpcm->informed_consent_autentikasi) == null ? 'checked' : '' }}
                                        class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                    <label for="tidak-lengkap-no-rm" class="text-gray-700">Tidak Ada</label>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- PENDOKUMENTASIAN YANG BENAR --}}

        <div class="bg-white px-2 py-1 shadow-lg rounded-lg w-full mt-1">
            <h2 class="text-xl font-bold text-center mb-5">PENDOKUMENTASIAN YANG BENAR</h2>
            <div class="grid gap-5 md:grid-cols-2 sm:grid-cols-1">
                <div>
                    {{-- No RM --}}
                    <div class="mb-1">
                        <div class="flex items-center space-x-4">
                            <label for="no-rm" class="font-bold mb-1 md:w-40 sm:w-20">Kejelasan</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="lengkap-no-rm" name="kejelasan" value="1"
                                    {{ old('kejelasan', $klpcm->kejelasan) == 1 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="lengkap-no-rm" class="text-gray-700">Benar</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="tidak-lengkap-no-rm" name="kejelasan" value="0"
                                    {{ old('kejelasan', $klpcm->kejelasan) == 0 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="tidak-lengkap-no-rm" class="text-gray-700">Tidak Benar</label>
                            </div>
                        </div>
                    </div>

                    {{-- Nama --}}
                    <div class="mb-1">
                        <div class="flex items-center space-x-4">
                            <label for="nama" class="font-bold mb-1 md:w-40 sm:w-20">Keterbacaan</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="lengkap-nama" name="keterbacaan" value="1"
                                    {{ old('keterbacaan', $klpcm->keterbacaan) == 1 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="lengkap-nama" class="text-gray-700">Benar</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="tidak-lengkap-nama" name="keterbacaan" value="0"
                                    {{ old('keterbacaan', $klpcm->keterbacaan) == 0 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="tidak-lengkap-nama" class="text-gray-700">Tidak Benar</label>
                            </div>
                        </div>
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-1">
                        <div class="flex items-center space-x-4">
                            <label for="jenis_kelamin" class="font-bold mb-1 md:w-40 sm:w-20">Pembetulan Kesalahan</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="lengkap-jenis-kelamin" name="pembetulan_kesalahan"
                                    value="1"
                                    {{ old('pembetulan_kesalahan', $klpcm->pembetulan_kesalahan) == 1 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="lengkap-jenis-kelamin" class="text-gray-700">Benar</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="tidak-lengkap-jenis-kelamin" name="pembetulan_kesalahan"
                                    value="0"
                                    {{ old('pembetulan_kesalahan', $klpcm->pembetulan_kesalahan) == 0 ? 'checked' : '' }}
                                    class="appearance-none h-4 w-4 border border-gray-300 rounded-md checked:bg-blue-500 focus:outline-none">
                                <label for="tidak-lengkap-jenis-kelamin" class="text-gray-700">Tidak Benar</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-[#fff4cd] px-2 py-1 shadow-lg rounded-lg w-full mt-1">
            <div class="flex justify-between w-full py-2 px-2">
                @if ($klpcm->status_lengkap == 'belum-lengkap')
                    @if (auth()->user()->role == 'petugas penyimpanan')
                        <p class="text-left font-medium text-red-600" style="color: red">Formulir belum lengkap! Kirim
                            notifikasi.</p>
                        <div class="flex gap-4">
                            <button type="submit" class="bg-blue-600 px-4 py-2 text-white rounded">Simpan
                                Perbaruan!</button>
                            <button type="button" id="notification-btn"
                                class="bg-[#4d869c] px-4 py-2 text-white rounded">Notifikasi
                                Whatsapp!</button>
                        </div>
                    @endif
                @else
                    <p class="text-left font-medium">yeay formulir kamu sudah lengkap!</p>
                @endif
            </div>
        </div>

    </form>



    <div id="notification-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-4 rounded shadow-lg w-1/3">
            <h2 class="text-lg font-bold">Rekam medis {{ $klpcm->klpcm->no_rm }}</h2>
            <p class="text-md font-bold">Nama : {{ $klpcm->nama_string }}</p>
            <p class="text-md font-bold">Poli : {{ $klpcm->poli }}</p>

            <div class="border border-black mt-3"></div>

            <p class="text-md font-bold">Peminjam : {{ $klpcm->nama_peminjam }}</p>
            <p class="text-md font-bold">Nomor Whatsapp : {{ $klpcm->no_wa }}</p>

            <p class="text-md font-bold">
                "{{ $pesan }}"
            </p>

            <div class="mt-4 flex justify-end">
                @if ($klpcm->status_lengkap == 'belum-lengkap')
                    <form action="{{ route('data-distribusi.send-notifikasi', ['id' => $klpcm->id]) }}" method="post">
                        <button id="close-modal" type="button"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Batal</button>
                        @csrf
                        <button type="submit"
                            class="bg-[#4caf50] hover:bg-[#245425] text-white font-bold py-2 px-4 rounded">Ya, Kirim
                            Notifikasi</button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <script>
        const userRole = "{{ auth()->user()->role }}"

        window.onload = function() {
            if (userRole !== 'petugas penyimpanan') {
                const formElements = document.querySelectorAll('input');
                formElements.forEach(element => {
                    console.log(element)
                    element.setAttribute('disabled', true);
                });
            }
        };


        document.getElementById('notification-btn').addEventListener('click', function() {
            document.getElementById('notification-modal').classList.remove('hidden');
        });

        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('notification-modal').classList.add('hidden');
        });
    </script>
@endsection
