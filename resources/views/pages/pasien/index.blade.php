@extends('layouts.home')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-center">DATA PASIEN PUSKESMAS BUKIT WOLO INDAH</h1>
        <div class="flex flex-col md:flex-row justify-between items-start mb-4 gap-5">
            <!-- Button to trigger modal -->
            <div class="flex gap-2">
                <button id="uploadButton"
                    class="bg-[#4d869c] hover:bg-[#2a4b58] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline uppercase">
                    Upload Data
                </button>
                <a href="{{ route('pasien.download', ['id' => 1]) }}" target="_blank"
                    class="bg-[#4d869c] hover:bg-[#2a4b58] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline uppercase">
                    Download Templates
                </a>
            </div>

            <div class="relative">
                <form action="{{ route('pasien.index') }}" method="GET">
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

        <!-- Alert Component -->
        <x-alert />

        <!-- Data Table -->
        <div class="container overflow-x-auto bg-white">
            <table class="w-full border-collapse border rounded-md shadow-md">
                <thead>
                    <tr class="bg-gray-600 text-left font-medium text-white">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">No Rm</th>
                        <th class="px-4 py-2">Kode Wilayah</th>
                        <th class="px-4 py-2">Nama</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasiens as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $item->no_rm }}</td>
                            <td class="px-4 py-2">{{ $item->kode_wilayah }}</td>
                            <td class="px-4 py-2">{{ $item->nama }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pasiens->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="flex justify-between items-center p-4 border-b">
                <h2 class="text-xl font-semibold">Upload Data Pasien</h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    &times;
                </button>
            </div>
            <div class="p-4">
                <form action="{{ route('pasien.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="file" class="block text-sm font-medium text-gray-700">Pilih File</label>
                        <input type="file" name="file" id="file" accept=".xlsx"
                            class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" id="cancelUpload"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">Batal</button>
                        <button type="submit"
                            class="bg-[#4d869c] hover:bg-[#2a4b58] text-white font-bold py-2 px-4 rounded">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const uploadButton = document.getElementById('uploadButton');
            const uploadModal = document.getElementById('uploadModal');
            const closeModal = document.getElementById('closeModal');
            const cancelUpload = document.getElementById('cancelUpload');

            // Show the modal when the button is clicked
            uploadButton.addEventListener('click', () => {
                uploadModal.classList.remove('hidden');
            });

            // Close the modal when the close button or cancel button is clicked
            closeModal.addEventListener('click', () => {
                uploadModal.classList.add('hidden');
            });

            cancelUpload.addEventListener('click', () => {
                uploadModal.classList.add('hidden');
            });

            // Close the modal when clicking outside of it
            uploadModal.addEventListener('click', (e) => {
                if (e.target === uploadModal) {
                    uploadModal.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
