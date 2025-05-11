<x-layout-admin>
    <x-slot name="header">

    </x-slot>

    <body class="bg-gray-100">
        <div class="flex h-screen flex-col">
            <!-- Main Content -->
            <div class="flex-grow bg-white p-6">
                <div class="mb-6">
                    <div class="text-lg font-bold">Manajemen Jenis Pembayaran</div>
                </div>
                <div class="flex items-center mb-4 justify-between">
                    <div class="border border-gray-300 p-3 rounded flex items-center">
                        <form method="GET" action="{{ route('admin.filter-jenis-pembayaran') }}">
                        <select name="unitpendidikan" class="border border-gray-300 p-2 rounded mr-5 w-48" onchange="this.form.submit()">
    <option value="" {{ request('unitpendidikan') == '' ? 'selected' : '' }}>Pilih Unit</option>
    <option value="2" {{ request('unitpendidikan') == '2' ? 'selected' : '' }}>TK</option>
    <option value="3" {{ request('unitpendidikan') == '3' ? 'selected' : '' }}>SD</option>
    <option value="4" {{ request('unitpendidikan') == '4' ? 'selected' : '' }}>SMP</option>
    <option value="5" {{ request('unitpendidikan') == '5' ? 'selected' : '' }}>SMA</option>
    <option value="6" {{ request('unitpendidikan') == '6' ? 'selected' : '' }}>MADIN</option>
    <option value="7" {{ request('unitpendidikan') == '7' ? 'selected' : '' }}>TPQ</option>
    <option value="8" {{ request('unitpendidikan') == '8' ? 'selected' : '' }}>Ya Pondok</option>
    <option value="9" {{ request('unitpendidikan') == '9' ? 'selected' : '' }}>Tidak Pondok</option>
</select>

                            <select name="status" class="border border-gray-300 p-2 rounded mr-5 w-48"
                                onchange="this.form.submit()">
                                <option value="">Pilih Status</option>
                                <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Non Aktif" {{ request('status') == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                            </select>

                        </form>
                    </div>
                    <a href="{{ route('admin.create-jenis-pembayaran') }}">
                        <button class="bg-green-500 text-white p-2 rounded">+ Tambah Data</button>
                    </a>
                </div>

                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center">
                        <label class="mr-2" for="entries">Show</label>
                        <select class="border border-gray-300 p-2 rounded mr-2 w-20" id="entries">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span class="ml-2">entries</span>
                    </div>
                    <div class="flex items-center">
                        <label class="mr-2" for="search">Cari :</label>
                        <input class="border border-gray-300 p-2 rounded w-64" id="search" type="text"
                            placeholder="Masukkan kata kunci..." />
                    </div>
                </div>
                <hr class="border-gray-300 mb-4" />
                <div class="overflow-x-auto">
                    <table id="data-table" class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr class="bg-green-500 text-white">
                                <th class="py-2 px-4 border-b border-r border-gray-300 text-left" colspan="9">
                                    Data Pembayaran
                                </th>
                            </tr>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="py-1 px-4 border-b border-r border-gray-300 text-left w-16">No.</th>
                                <th class="py-1 px-4 border-b border-r border-gray-300 text-left w-16">Unit.</th>
                                <th class="py-1 px-4 border-b border-r border-gray-300 text-left">Nama Pembayaran</th>
                                <th class="py-1 px-4 border-b border-r border-gray-300 text-left">Tipe Pembayaran</th>
                                <th class="py-1 px-4 border-b border-r border-gray-300 text-left">Tahun</th>
                                <th class="py-1 px-4 border-b border-r border-gray-300 text-left">Nominal</th>
                                <th class="py-1 px-4 border-b border-r border-gray-300 text-left">Status</th>
                                <th class="py-1 px-4 border-b border-r border-gray-300 text-left w-24">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filtered_data as $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="border px-4 py-2 text-left">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2 text-left">{{ $item->namaUnit }}</td>
                                    <!-- Gabungkan Nama Pembayaran dengan Unit -->
                                    <td class="border px-4 py-2 text-left">
                                    {{ $item->namaUnit }} - {{ $item->nama_pembayaran }}</td>
                                    <td class="border px-4 py-2 text-left">{{ $item->type }}</td>
                                    <td class="border px-4 py-2 text-left">{{ $item->tahun_ajaran}}/{{ (int) $item->tahun_ajaran + 1 }}</td>
                                    <td class="border px-4 py-2 text-left">{{ $item->nominal_jenispembayaran }}</td>
                                    <td class="border px-4 py-2 text-left">{{ $item->status }}</td>
                                    <td class="border px-4 py-2 text-left">
                                        <a
                                            href="{{ route('admin.edit-jenis-pembayaran', ['id' => $item->idjenispembayaran]) }}">
                                            <button class="bg-yellow-300 text-white p-2 rounded">Edit</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>

        <script>
            // Variabel global untuk menyimpan hasil pencarian
            let filteredRows = [];

            // Fungsi untuk memfilter jumlah baris yang ditampilkan
            function filterRowsByEntries(maxRows) {
                // Gunakan hasil pencarian jika ada, jika tidak gunakan semua baris
                const rows = filteredRows.length ? filteredRows : document.querySelectorAll('#data-table tbody tr');

                document.querySelectorAll('#data-table tbody tr').forEach(row => {
                    row.style.display = 'none'; // Sembunyikan semua baris terlebih dahulu
                });

                // Tampilkan baris sesuai jumlah yang dipilih
                rows.forEach((row, index) => {
                    if (index < maxRows) {
                        row.style.display = ''; // Tampilkan baris
                    }
                });
            }

            // Event Listener untuk mengubah jumlah entri
            document.getElementById('entries').addEventListener('change', function () {
                const maxRows = parseInt(this.value);
                filterRowsByEntries(maxRows);
            });

            // Fungsi pencarian
            function searchTable(filter) {
                const rows = document.querySelectorAll('#data-table tbody tr');
                filteredRows = []; // Reset hasil pencarian

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(filter)) {
                        filteredRows.push(row); // Tambahkan baris yang cocok ke hasil pencarian
                    }
                });

                // Terapkan hasil pencarian dan tampilkan hanya jumlah baris yang sesuai
                filterRowsByEntries(parseInt(document.getElementById('entries').value));
            }

            // Event Listener untuk pencarian
            document.getElementById('search').addEventListener('input', function () {
                const filter = this.value.toLowerCase();
                searchTable(filter);
            });

            // Set default perilaku saat halaman dimuat
            window.addEventListener('load', function () {
                const maxRows = parseInt(document.getElementById('entries').value);
                filterRowsByEntries(maxRows);
            });

            // Fungsi untuk memformat angka menjadi Rupiah
            function formatRupiah(angka) {
                return 'Rp. ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            // Terapkan format Rupiah pada kolom Nominal
            document.querySelectorAll('td[data-nominal]').forEach(td => {
                const nominal = parseInt(td.dataset.nominal, 10);
                td.textContent = formatRupiah(nominal);
            });

        </script>
    </body>

</x-layout-admin>