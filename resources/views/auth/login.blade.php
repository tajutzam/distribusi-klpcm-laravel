@extends('layouts.auth')

@section('content')
    <div class="bg-sky-300 bg-opacity-20 p-8 md:p-16 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl md:text-3xl font-bold mb-6 text-white text-center">Sistem Distribusi dan Pengecekan
            Ketidaklengkapan Catatan Rekam Medis</h2>
        <x-alert />
        <div class="bg-[#90c0e7] p-6 rounded-lg shadow-lg">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-white">Username</label>
                    <input type="text" name="username" id="username"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-white">Password</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-dark bg-white hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
