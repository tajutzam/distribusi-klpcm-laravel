@extends('layouts.home')

@section('content')
    <div class="container mx-auto p-4">
        <x-alert />

        <div class="container overflow-x-auto">
            <table id="myTable" class="w-full border-collapse border rounded-md shadow-md">
                <thead>
                    <tr class="bg-gray-600 text-left font-medium text-white">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2 cursor-pointer sort-header" data-column="tanggal_pinjam">Tanggal Kunjungan</th>
                        <th class="px-4 py-2">Keperluan</th>
                        <th class="px-4 py-2">No RM</th>
                        <th class="px-4 py-2 cursor-pointer sort-header" data-column="kode_wilayah">Kode Wilayah</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2 cursor-pointer sort-header" data-column="status_lengkap">Status Kelengkapan
                        </th>
                        <th class="px-4 py-2">Status Kembali</th>
                        <th class="px-4 py-2 cursor-pointer sort-header" data-column="poli">Poli</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($klpcms as $item)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2">{{ $item->keperluan }}</td>
                            <td class="px-4 py-2">{{ $item->klpcm->no_rm }}</td>
                            <td class="px-4 py-2">{{ $item->kode_wilayah }}</td>
                            <td class="px-4 py-2">{{ $item->nama_string }}</td>
                            <td class="px-4 py-2">{{ $item->status_lengkap }}</td>
                            <td class="px-4 py-2">{{ $item->status_kembali }}</td>
                            <td class="px-4 py-2">{{ $item->poli }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('distribusi.show', ['distribusi' => $item->id]) }}"><i
                                        class="fas fa-eye mr-2"></i></a>

                                <form action="{{ route('distribusi.destroy', ['distribusi' => $item->id]) }}"
                                    method="post" onsubmit="return confirm('Are you sure you want to delete this item?');">
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

@section('scripts')
    <script>
        let table = new DataTable('#myTable', {
            responsive: true
        });
        console.log(table)
    </script>
@endsection

@endsection
