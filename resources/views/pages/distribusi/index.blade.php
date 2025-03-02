@extends('layouts.home')

@section('content')
    <div class="container mx-auto p-4">
        <x-alert />
        <div class="container overflow-x-auto">
            <table class="w-full border-collapse border rounded-md shadow-md mt-2">
                <thead>
                    <tr class="bg-gray-600 text-left font-medium text-white">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">No RM</th>
                        <th class="px-4 py-2">Kode Wilayah</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Keperluan</th>
                        <th class="px-4 py-2">Poli</th>
                        <th class="px-4 py-2">Tanggal Pinjam</th>
                        <th class="px-4 py-2">Tanggal Kembali</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($klpcms as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $item->klpcm->no_rm }}</td>
                            <td class="px-4 py-2">{{ $item->kode_wilayah }}</td>
                            <td class="px-4 py-2">{{ $item->nama_string }}</td>
                            <td class="px-4 py-2">{{ $item->keperluan }}</td>
                            <td class="px-4 py-2">{{ $item->poli }}</td>
                            <td class="px-4 py-2">{{ $item->tanggal_pinjam }}</td>

                            <td class="px-4 py-2">{{ $item->tanggal_dikembalikan ?? 'Belum Dikembalikan' }}</td>
                            <td class="space-x-2 flex">
                                <a href="{{ route('distribusi.edit', ['distribusi' => $item->id]) }}"><i
                                        class="fas fa-edit mr-2"></i></a>
                                <form action="{{ route('rekam-medis.destroy', ['rekam_medi' => $item]) }}"
                                    class="inline-block" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit">
                                        <i class="fas fa-trash mr-2"></i>
                                    </button>
                                </form>
                                <a href=""><i class="fa-solid fa-circle-info"></i></a>
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
