@extends('layouts.home')

@section('content')
    <div class="container mx-auto p-4">
        <x-alert />
        <div class="container overflow-x-auto">
            <table class="w-full border-collapse border rounded-md shadow-md">
                <thead>
                    <tr class="bg-gray-600 text-left font-medium text-white">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Tanggal Kunjungan</th>
                        <th class="px-4 py-2">No RM</th>
                        <th class="px-4 py-2">Kode Wilayah</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Status Kelengkapan</th>
                        <th class="px-4 py-2">Status Kembali</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($klpcms as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2">{{ $item->klpcm->no_rm }}</td>
                            <td class="px-4 py-2">{{ $item->kode_wilayah }}</td>
                            <td class="px-4 py-2">{{ $item->nama_string }}</td>
                            <td class="px-4 py-2">{{ $item->status_lengkap }}</td>
                            <td class="px-4 py-2">{{ $item->status_kembali }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <!-- Konfirmasi Button -->
                                <a href="{{ route('distribusi.show', ['distribusi' => $item->id]) }}"><i
                                        class="fas fa-eye mr-2"></i></a>

                                <!-- Hapus Button -->
                                <form action="{{ route('distribusi.destroy', ['distribusi' => $item->id]) }}" method="post"
                                    onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="">
                                        <i class="fas fa-trash mr-2"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Pagination Links -->
        <div class="mt-4 flex justify-center">
            {{ $klpcms->links('pagination::tailwind') }}
        </div>
    </div>

    <script>
        document.querySelectorAll('[id^="confirmButton"]').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const id = this.id.replace('confirmButton', '');
                document.getElementById(`modal${id}`).classList.remove('hidden');
            });
        });

        document.querySelectorAll('.closeButton').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.modalId;
                document.getElementById(`modal${id}`).classList.add('hidden');
            });
        });
    </script>
@endsection
