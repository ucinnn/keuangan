<x-layout-admin>
    <x-slot name="header">
    </x-slot>

    <!-- Konten halaman -->
    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta content="width=device-width, initial-scale=1.0" name="viewport" />
            <title>Manajemen Data Jenis Pemasukan</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        </head>

        <body class="bg-gray-100">
            <div class="flex h-screen">
                <!-- Main Content -->
                <div class="flex-1 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div class="text-2xl font-bold">Manajemen Data Pemasukan</div>
                    </div>

                    <div class="bg-white p-4 rounded shadow">
                        <div class="flex justify-between items-center mb-4">
                            <form method="GET" action="{{ route('admin.filter-jenis-pembayaran') }}" class="flex items-center space-x-4">
                                <!-- Dropdown Filter Unit Pendidikan -->
                                <select name="unitpendidikan" class="border border-gray-300 rounded p-2 text-sm" onchange="this.form.submit()">
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

                                <!-- Dropdown Filter Status -->
                                <select name="status" class="border border-gray-300 rounded p-2 text-sm" onchange="this.form.submit()">
                                    <option value="">Pilih Status</option>
                                    <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Non Aktif" {{ request('status') == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                                </select>
                            </form>

                            <!-- Button Tambah Data -->
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('admin.create-jenis-pembayaran') }} ">
                                    <x-primary-button class="bg-green-500 text-white px-4 py-2 rounded flex items-center">
                                        <i class="fas fa-plus mr-2"></i>
                                        {{ __('Tambah Data') }}
                                    </x-primary-button>
                                </a>
                            </div>
                        </div>

                        <!-- Filter Entries -->
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center space-x-2">
                            <form method="GET" action="{{ route('admin.filter-jenis-pembayaran') }}">
    <label class="text-sm" for="show">Show</label>
    <select class="border border-gray-300 rounded p-2" id="show" name="show" onchange="this.form.submit()">
        <option value="10" {{ request('show') == 10 ? 'selected' : '' }}>10</option>
        <option value="25" {{ request('show') == 25 ? 'selected' : '' }}>25</option>
        <option value="50" {{ request('show') == 50 ? 'selected' : '' }}>50</option>
        <option value="1" {{ request('show') == 1 ? 'selected' : '' }}>1</option>
    </select>
    <label class="text-sm" for="show">entries</label>
</form>
                            </div>

                            <!-- Search Input -->
                            <div class="w-full sm:w-1/2 flex">
                                <input class="block w-full p-3 border border-gray-300 rounded flex-grow" id="search" type="text" placeholder="Cari Nama Pembayaran..." />
                            </div>
                        </div>

                        <div class="mb-4">
                        <span id="totalItems" class="text-sm font-medium text-gray-700">Total Data: {{ $filtered_data->total() }}</span>
                        </div>

                        <div id="noDataMessage" class="p-4 bg-yellow-200 text-yellow-800 rounded-lg mb-4 hidden">
                            <p>Maaf, saat ini tidak ada data Jenis Pemasukan yang sesuai dengan pencarian.</p>
                        </div>

                        <hr class="border-gray-300 mb-4" />

                        <!-- Table for Data -->
                        <div class="overflow-x-auto">
                            <table id="data-table" class="min-w-full bg-white border border-gray-300">
                                <thead>
                                    <tr class="bg-green-500 text-white text-center">
                                        <th class="py-2 px-4 border-r border-gray-300 w-16">No.</th>
                                        <th class="py-2 px-4 border-r border-gray-300 w-16">Unit.</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Nama Pembayaran</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Tipe Pembayaran</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Tahun</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Nominal</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Status</th>
                                        <th class="py-2 px-4 border-r border-gray-300 w-24">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="dataRows">
                                    @foreach ($filtered_data as $item)
                                        <tr class="bg-white text-black text-center border-b border-gray-300" data-nama="{{ strtolower($item->nama_pembayaran) }} {{ strtolower($item->namaUnit) }}">
                                            <td class="py-2 px-4 border-r border-gray-300">{{ ($filtered_data->currentPage() - 1) * $filtered_data->perPage() + $loop->iteration }}</td>
                                            <td class="py-2 px-4 border-r border-gray-300">{{ $item->namaUnit }}</td>
                                            <!-- Gabungkan Nama Pembayaran dengan Unit -->
                                            <td class="py-2 px-4 border-r border-gray-300">
                                                {{ $item->namaUnit }} - {{ $item->nama_pembayaran }}
                                            </td>
                                            <td class="py-2 px-4 border-r border-gray-300">{{ $item->type }}</td>
                                            <td class="py-2 px-4 border-r border-gray-300">{{ $item->tahun_ajaran }}/{{ (int) $item->tahun_ajaran + 1 }}</td>
                                            <td class="py-2 px-4 border-r border-gray-300">{{ $item->nominal_jenispembayaran }}</td>
                                            <td class="py-2 px-4 border-r border-gray-300">
                                            @if($item->status === 'Aktif')
          <span class="px-2 py-1 font-semibold text-green-700 bg-green-100 rounded-full">Aktif</span>
        @else
          <span class="px-2 py-1 font-semibold text-red-700 bg-red-100 rounded-full">Non Aktif</span>
        @endif
                                            </td>
                                            <td class="py-2 px-4 border-r border-gray-300">
                                                <a href="{{ route('admin.edit-jenis-pembayaran', ['id' => $item->idjenispembayaran]) }} "
                                                class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-xs font-medium rounded hover:bg-yellow-900 transition duration-150 ease-in-out">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-1.036L6.75 17.75a2 2 0 11-2.829-2.829L13.5 4.5m1.061-1.061L17.5 7.5m-3.061-4.061a2 2 0 113.536 1.536L8.75 16.25a2 2 0 11-2.829-2.829L13.5 4.5m1.061-1.061z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
    {{ $filtered_data->links() }}
</div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const searchInput = document.getElementById('search'); // Input search
                    const dataRows = document.querySelectorAll('#dataRows tr'); // All data rows
                    const totalItemsElement = document.getElementById('totalItems'); // Total items text
                    const noDataMessage = document.getElementById('noDataMessage'); // No data message

                    // Fungsi untuk memperbarui total items
                    function updateTotalItems() {
                        const visibleRows = Array.from(dataRows).filter(row => row.style.display !== 'none');
                        totalItemsElement.textContent = `Total Data: ${visibleRows.length}`;
                        
                        // Show/hide 'No Data' message
                        if (visibleRows.length === 0) {
                            noDataMessage.classList.remove('hidden');
                        } else {
                            noDataMessage.classList.add('hidden');
                        }
                    }

                    // Pencarian
                    searchInput.addEventListener('input', function () {
                        const searchTerm = searchInput.value.toLowerCase();
                        dataRows.forEach(row => {
                            const textContent = row.getAttribute('data-nama'); // Menggunakan data-nama
                            if (textContent.includes(searchTerm)) {
                                row.style.display = ''; // Tampilkan jika cocok
                            } else {
                                row.style.display = 'none'; // Sembunyikan jika tidak cocok
                            }
                        });
                        updateTotalItems(); // Update jumlah data yang terlihat
                    });

                    updateTotalItems(); // Update jumlah data ketika pertama kali dimuat
                });
            </script>
        </body>
    </html>
</x-layout-admin>
