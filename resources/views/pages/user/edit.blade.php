@extends('layouts.home')

@section('content')
    <div class="flex justify-center items-center min-h-screen">
        <section class="bg-white px-4 py-4 rounded-lg w-full max-w-lg">
            <x-alert />
            <form action="{{ route('user.update', $user->id) }}" class="w-full" method="POST">
                @csrf
                @method('PUT')
                <div class="flex flex-wrap -mx-3 mb-6">
                    <!-- NIP Field -->
                    <div class="w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nip">
                            NIP
                        </label>
                        <input name="nip" value="{{ old('nip', $user->nip) }}"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="nip" type="text" placeholder="Enter NIP">
                    </div>
                    <!-- Name Field -->
                    <div class="w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            Nama
                        </label>
                        <input name="name" value="{{ old('name', $user->name) }}"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="name" type="text" placeholder="Enter Name">
                    </div>

                    <!-- Access Field -->
                    {{-- <div class="w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="access">
                            Akses
                        </label>
                        <div class="relative">
                            <select name="role"
                                class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="access">
                                <option value="kepala puskesmas" {{ $user->role == 'kepala puskesmas' ? 'selected' : '' }}>Kepala puskesmas</option>
                                <option value="petugas loket" {{ $user->role == 'petugas loket' ? 'selected' : '' }}>Petugas loket</option>
                                <option value="petugas penyimpanan" {{ $user->role == 'petugas penyimpanan' ? 'selected' : '' }}>Petugas penyimpanan</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Username Field -->
                    <div class="w-full px-3 mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="username">
                            Username
                        </label>
                        <input
                        value="{{old('username', $user->username)}}"

                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="username" name="username" type="text" placeholder="Enter Username">
                    </div>
                    <!-- Password Field -->
                    <div class="flex">
                        <div class=" px-3 mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="password">
                                Password
                            </label>
                            <input name="password"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="password" type="password" placeholder="******************">
                            <p class="text-gray-600 text-xs italic">Leave it blank if you don't want to change the password</p>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class=" px-3 mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="confirm-password">
                                Confirm Password
                            </label>
                            <input name="password_confirmation"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="confirm-password" type="password" placeholder="******************">
                            <p class="text-gray-600 text-xs italic">Please re-enter your password for confirmation</p>
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
    <a href="{{ route('user.index') }}" class="px-4 py-2 bg-[#4d869c] rounded-md text-white hover:bg-[#2d5261]">Kembali</a>
@endsection
