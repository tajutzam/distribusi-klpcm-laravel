@extends('layouts.home')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-center">DATA USER</h1>
        <div class="flex flex-col md:flex-row justify-between items-start mb-4 gap-5 ">
            <a href="{{ route('user.create') }}"
                class="bg-[#4d869c] hover:bg-[#2a4b58] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Tambah Data User
            </a>
            <div class="relative">
                <form action="{{ route('user.index') }}" method="GET">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="rounded-md shadow-sm p-2 border-gray-300 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                        placeholder="Cari...">
                    <button type="submit" class="absolute right-3 top-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        <x-alert />
        <div class="container overflow-x-auto">
            <table class="w-full border-collapse border  rounded-md shadow-md">
                <thead>
                    <tr class="bg-gray-600  text-left font-medium text-white">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Akses</th>
                        <th class="px-4 py-2">Username</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $item->name }}</td>
                            <td class="px-4 py-2">{{ $item->role }}</td>
                            <td class="px-4 py-2">{{ $item->username }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('user.edit', ['user' => $item->id]) }}"
                                    class="bg-[#4d869c] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</a>
                                <form action="{{ route('user.destroy', ['user' => $item->id]) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit"
                                        class="bg-[#4d869c] hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4 flex justify-center">
            {{ $users->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
