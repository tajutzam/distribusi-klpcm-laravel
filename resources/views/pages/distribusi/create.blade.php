@extends('layouts.home')

@section('content')
    <form action="{{ route('rekam-medis.store') }}" method="post">
        @csrf
        <div class="flex flex-col md:flex-row gap-3">
            <!-- Card 1 -->
            <div class="bg-white p-7 shadow-lg rounded-lg w-full">
                <h1 class="text-xl font-bold mb-4 text-center">Data Peminjaman</h1>
                <!-- Input Fields Row 1 -->
                <div class="flex flex-col md:flex-row justify-between gap-2">
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input1">
                            Nomor Rekam Medis <span class="text-red-500">*</span>
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="no-rm-input" type="text" value="{{ old('no_rm') }}" name="no_rm"
                            placeholder="Enter text" autocomplete="off">
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input2">
                            Kode Wilayah <span class="text-red-500">*</span>
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="kode_wilayah" type="text" value="{{ old('kode_wilayah') }}" name="kode_wilayah"
                            placeholder="Enter text">
                    </div>
                </div>
                <!-- Input Fields Row 2 -->
                <div class="flex flex-col md:flex-row justify-between gap-2">
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input3">
                            Nama <span class="text-red-500">*</span>
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="nama" type="text" value="{{ old('nama') }}" name="nama_string"
                            placeholder="Enter text">
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input4">
                            Keperluan <span class="text-red-500">*</span>
                        </label>
                        <select name="keperluan" id="input4"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="" disabled selected>Pilih Keperluan</option>
                            <option value="Berobat">Berobat</option>
                            <option value="Penelitian">Penelitian</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <!-- Input tambahan untuk keperluan lainnya (disembunyikan default) -->
                    <div class="mb-4 w-full hidden" id="keperluanLainnya">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="keperluanInput">
                            Keperluan Lainnya <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="keperluan_lainya" id="keperluanInput"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan keperluan lainnya">
                    </div>
                </div>
                <div id="perawat-container"></div>

                <!-- Input Fields Row 3 -->
                <div class="flex flex-col md:flex-row justify-between gap-2">
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input5">
                            Poli <span class="text-red-500">*</span>
                        </label>
                        <select name="poli"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="poly-selected">
                            <option value="" disabled selected>Pilih Poli</option>
                            <option value="Poli Umum">Poli Umum</option>
                            <option value="Poli Gigi">Poli Gigi</option>
                            <option value="KIA/KB">KIA/KB</option>
                            <option value="Poli MTBS">Poli MTBS</option>
                        </select>
                    </div>
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input6">
                            Nama Peminjam <span class="text-red-500">*</span>
                        </label>
                        <input name="nama_peminjam"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="nama_peminjam" type="text" value="{{ old('nama_peminjam') }}" placeholder="Enter text">
                    </div>
                </div>
                <div class="mb-4 w-full">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="input6">
                        Nomor Whatsapp Peminjam <span class="text-red-500">*</span>
                    </label>
                    <input name="no_wa"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="no_wa" type="text" value="{{ old('no_wa') }}" placeholder="Enter text">
                </div>

            </div>


            @php
                use Carbon\Carbon;
                $today = Carbon::now()->toDateString();
                $nextDay = Carbon::now()->addDay()->toDateString();

            @endphp


            <!-- Card 2 -->
            <div class="bg-white p-7 shadow-lg rounded-lg w-full">
                <div class="flex flex-col md:flex-row justify-between gap-2">
                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input7">
                            Tanggal Pinjam <span class="text-red-500">*</span>
                        </label>
                        <input name="tanggal_pinjam" value="{{ old('tanggal_pinjam', $today) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="input7" type="date">
                    </div>

                    <div class="mb-4 w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input8">
                            Tanggal Kembali <span class="text-red-500">*</span>
                        </label>
                        <input name="tanggal_kembali" value="{{ old('tanggal_kembali', $nextDay) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="input8" type="date">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4 md:mt-0 w-full md:w-auto"
                        type="submit">
                        Submit
                        <i class="fa-solid fa-paper-plane" style="color: #ffffff;"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('scripts')
    <script>
        function clear(id) {
            document.getElementById(id).value = '';
        }


        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');



        document.getElementById('poly-selected').addEventListener('change', async function() {
            try {
                const response = await fetch("/poly/search", {
                    method: "POST", // Pastikan metode HTTP benar
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({
                        poly: this.value
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                const container = document.getElementById('perawat-container'); // Tempat untuk select perawat
                container.innerHTML = ""; // Kosongkan elemen sebelumnya

                if (data.data.length === 0) {
                    alert('Belum ada perawat untuk poli ' + this.value);
                    document.getElementById('no_wa').value = "";
                    document.getElementById('nama_peminjam').value = "";
                } else if (data.data.length === 1) {
                    // Jika hanya ada satu perawat, langsung isi input
                    document.getElementById('no_wa').value = data.data[0].no_wa;
                    document.getElementById('nama_peminjam').value = data.data[0].name;
                } else {
                    // Jika lebih dari satu, buat dropdown select
                    const select = document.createElement('select');
                    select.id = "select-perawat";
                    select.className =
                        "shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-3";

                    // Tambahkan opsi perawat ke dalam select
                    data.data.forEach(perawat => {
                        const option = document.createElement('option');
                        option.value = perawat.no_wa; // Gunakan no_wa sebagai nilai
                        option.textContent = perawat.name;
                        select.appendChild(option);
                    });

                    // Tambahkan select ke dalam container
                    container.appendChild(select);

                    // Set default nilai input dari perawat pertama
                    document.getElementById('no_wa').value = data.data[0].no_wa;
                    document.getElementById('nama_peminjam').value = data.data[0].name;

                    // Tambahkan event listener jika select berubah
                    select.addEventListener('change', function() {
                        const selectedPerawat = data.data.find(p => p.no_wa === this.value);
                        document.getElementById('no_wa').value = selectedPerawat.no_wa;
                        document.getElementById('nama_peminjam').value = selectedPerawat.name;
                    });
                }
            } catch (error) {
                console.error("Fetch error:", error);
            }
        });



        document.getElementById('no-rm-input').addEventListener('input', function() {
            const noRM = this.value;

            // Hanya melakukan pencarian jika input memiliki nilai
            if (noRM.trim() !== '') {
                fetch("/api/pasien/search", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            no_rm: noRM
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data)
                        if (data.status) {
                            console.log(data)
                            document.getElementById('kode_wilayah').value = data.data.kode_wilayah;
                            document.getElementById('nama').value = data.data.nama;
                        } else {
                            clear('kode_wilayah')
                            clear('nama')
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    });
            } else {}
        });

        document.getElementById("input4").addEventListener("change", function() {
            var inputLainnya = document.getElementById("keperluanLainnya");
            if (this.value === "Lainnya") {
                inputLainnya.classList.remove("hidden"); // Tampilkan input
                document.getElementById("keperluanInput").setAttribute("required", "true");
            } else {
                inputLainnya.classList.add("hidden"); // Sembunyikan input
                document.getElementById("keperluanInput").removeAttribute("required");
            }
        });
    </script>
@endsection
