@extends('layouts.home')

@section('content')
    <div class="container mx-auto p-4">
        <x-alert />
        <div class="container overflow-x-auto">
            <table class="w-full border-collapse border rounded-md shadow-md">
                <thead>
                    <tr class="bg-gray-600 text-left font-medium text-white">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">No RM</th>
                        <th class="px-4 py-2">Kode Wilayah</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Keperluan</th>
                        <th class="px-4 py-2">Poli</th>
                        <th class="px-4 py-2">Nama Peminjam</th>
                        <th class="px-4 py-2">Tanggal Pinjam</th>
                        <th class="px-4 py-2">Tanggal Kembali</th>
                        <th class="px-4 py-2">KLPCM</th>
                        <th class="px-4 py-2">Status KLPCM</th>
                        <th class="px-4 py-2">Status Lengkap</th>
                        <th class="px-4 py-2">Status Kembali</th>
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
                            <td class="px-4 py-2">{{ $item->nama_peminjam }}</td>
                            <td class="px-4 py-2">{{ $item->tanggal_pinjam }}</td>
                            <td class="px-4 py-2">{{ $item->tanggal_kembali }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('distribusi.show', ['distribusi' => $item->id]) }}"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Periksa</a>
                            </td>
                            <td class="px-4 py-2">{{ $item->true_percentage }} %</td>
                            <td class="px-4 py-2">{{ $item->status_lengkap }}</td>
                            <td class="px-4 py-2">{{ $item->status_kembali }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <!-- Konfirmasi Button -->
                                <a id="confirmButton{{ $item->id }}" href="#"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Konfirmasi</a>
                                <div id="modal{{ $item->id }}"
                                    class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                                    <div class="bg-white p-4 rounded shadow-lg w-1/3">
                                        <h2 class="text-lg font-bold">Rekam medis {{ $item->klpcm->no_rm }}</h2>
                                        <p class="text-md font-bold">Nama : {{ $item->nama_string }}</p>
                                        <p class="text-md font-bold">Poli : {{ $item->poli }}</p>

                                        @if ($item->status_kembali == 'kembali')
                                            <button class="bg-red-500 px-5 py-2 rounded text-white closeButton"
                                                data-modal-id="{{ $item->id }}">Close</button>
                                        @else
                                            <div class="flex gap-4 mt-2">
                                                <form class="inline"
                                                    action="{{ route('data-distribusi.update.status.kembali', ['id' => $item->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="text" hidden name="status" value="kembali">
                                                    <button class="bg-green-600 px-5 py-2 rounded text-white"
                                                        type="submit">Kembali</button>
                                                </form>
                                                <form class="inline"
                                                action="{{ route('data-distribusi.update.status.kembali', ['id' => $item->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('put')
                                                <input type="text" hidden name="status" value="belum-kembali">
                                                <button type="submit" class="bg-red-600 px-5 py-2 rounded text-white">Belum
                                                    Kembali</button>
                                            </form>
                                            </div>
                                        @endif

                                        @if ($item->status_kembali != 'kembali')
                                            <div class="border border-black mt-3">
                                            </div>
                                            <p class="text-md font-bold">Peminjam : {{ $item->nama_peminjam }}</p>
                                            <p class="text-md font-bold">Nomor Whatsapp : {{ $item->no_wa }}</p>

                                            <p class="text-md font-bold">"Rekam medis {{ $item->klpcm->no_rm }}
                                                ({{ $item->kode_wilayah }})
                                                atas nama {{ $item->nama_string }} , tujuan Poli
                                                {{ $item->poli }} {{ $item->status_kembali }}"</p>


                                            <div class="mt-4 flex justify-end">
                                                <button
                                                    class="closeButton bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2"
                                                    data-modal-id="{{ $item->id }}">Batal</button>

                                                @if ($item->status_kembali == 'belum-kembali')
                                                    <form class="inline"
                                                        action="{{ route('data-distribusi.send-notifikasi-belum-kembali', ['id' => $item->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('post')

                                                        <button type="submit"
                                                            class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Ya,
                                                            Kirim Notifikasi</button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- Hapus Button -->
                                <form action="{{ route('distribusi.destroy', ['distribusi' => $item->id]) }}"
                                    method="post" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @method('delete')
                                    @csrf
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Hapus</button>
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
