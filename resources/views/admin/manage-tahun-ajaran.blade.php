<x-layout-admin>
    <x-slot name="header">

    </x-slot>
    
    <html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Manajemen Tahun Ajaran           
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-gray-100">
  <div class="flex h-screen">
   <!-- Main Content -->
   <div class="flex-1 p-6">
    <div class="flex justify-between items-center mb-6">
     <div class="text-2xl font-bold">
      Manajemen Tahun Ajaran
     </div>
    </div>
    <div class="bg-white p-4 rounded shadow">
     <div class="flex justify-between items-center mb-4">
      <div class="flex items-center space-x-4">
        <form method="GET" action="{{ route('admin.manage-tahun-ajaran') }}" class="mb-4 flex items-center space-x-4">
            <!-- Filter Status -->
            <label class="text-sm" for="status">Filter Status:</label>
            <select name="status" id="status" class="border border-gray-300 rounded p-2 w-40" onchange="this.form.submit()">
                <option value="Semua" {{ request('status', 'Semua') == 'Semua' ? 'selected' : '' }}>Semua</option>
                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="non aktif" {{ request('status') == 'non aktif' ? 'selected' : '' }}>Non Aktif</option>
            </select>

            <!-- Garis Pemisah -->
            <div class="border-l border-gray-300 h-6"></div>

            <!-- Filter Jumlah Entri -->
            <label class="text-sm" for="entries">Show</label>
            <select name="entries" id="entries" class="border border-gray-300 rounded p-2 w-20" onchange="this.form.submit()">
                <option value="10" {{ request('entries', 10) == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ request('entries', 10) == 20 ? 'selected' : '' }}>20</option>
                <option value="30" {{ request('entries', 10) == 30 ? 'selected' : '' }}>30</option>
                <option value="50" {{ request('entries', 10) == 50 ? 'selected' : '' }}>50</option>
            </select>
            <label class="text-sm" for="entries">entries</label>
        </form>
      </div>
       <a href="{{ route('admin.create-tahun-ajaran') }}">
                    <x-primary-button class="bg-green-500 text-white px-4 py-2 rounded flex items-center">
                    <i class="fas fa-plus mr-2">
                    </i>
                        {{ __('Tambah Data') }}
                    </x-primary-button>
        </a>
      </div>
     <div class="flex justify-between items-center mb-4">
      <div class="flex items-center space-x-2">

      </div>
        <form method="GET" action="{{ route('admin.manage-tahun-ajaran') }}" class="flex items-center space-x-2 w-full max-w-lg">
            <label class="text-sm" for="search">Cari :</label>
            <input
                class="border border-gray-300 rounded p-2 flex-grow"
                id="search"
                name="search"
                type="text"
                placeholder="Cari Tahun Ajaran..."
                value="{{ request('search') }}"
            />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cari</button>
        </form>
     </div>
     <hr class="border-gray-300 mb-4" />
     <div class="overflow-x-auto">
        <table id="data-table" class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-green-500 text-white">
                <th class="py-2 px-4 border-b border-r border-gray-300 text-left" colspan="9">
                    Data Tahun Ajaran
                </th>
                </tr>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="py-1 px-4 border-b border-r border-gray-300 text-center w-16">No.</th>
                        <th class="py-1 px-4 border-b border-r border-gray-300 text-center w-60">Tahun Ajaran</th>
                        <th class="py-1 px-4 border-b border-r border-gray-300 text-center">Awal</th>
                        <th class="py-1 px-4 border-b border-r border-gray-300 text-center">Akhir</th>
                        <th class="py-1 px-4 border-b border-r border-gray-300 text-center w-60">Status</th>
                        <th class="py-1 px-4 border-b border-r border-gray-300 text-center w-24">Aksi</th>
                    </tr>
        </thead>
            <tbody>
                @foreach ($tahunajaran as $no=>$data)
                <tr class="bg-gray-25">
                    <td class="py-1.5 px-4 border-b border-r border-gray-300 text-center w-16">
                        {{ ($tahunajaran->currentPage() - 1) * $tahunajaran->perPage() + $loop->iteration }}
                    </td>
                    <td class="py-1.5 px-4 border-b border-r border-gray-300 text-center w-60">
                        {{ (int) $data->tahun_ajaran }}/{{ (int) $data->tahun_ajaran + 1 }}
                    </td>
                    <td class="py-1.5 px-4 border-b border-r border-gray-300 text-center">
                        {{ $data->awal }}
                    </td>
                    <td class="py-1.5 px-4 border-b border-r border-gray-300 text-center">
                        {{ $data->akhir }}
                    </td>
                    <td class="py-1.5 px-4 border-b border-r border-gray-300 text-center w-60">
                        <span class="px-2 py-1 rounded
                            {{ $data->status == 'Aktif' ? 'bg-blue-500 text-white' : 'bg-gray-300 text-black' }}">
                            {{ ($data->status) }}
                        </span>
                    </td>
                    <td class="py-1.5 px-4 border-b text-center w-24">
                        <a href="{{ route('admin.edit-tahun-ajaran', $data->id) }}">
                            <button class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    <div class="mt-4">
        {{ $tahunajaran->appends([
            'entries' => request('entries'),
            'status' => request('status'),
            'search' => request('search')
        ])->links() }}
    </div>
     </div>
    </div>
   </div>
  </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let allRows = Array.from(document.querySelectorAll("#data-table tbody tr"));
            const entriesSelect = document.getElementById("entries");

            function filterRowsByEntries(maxRows) {
                // Sembunyikan semua baris terlebih dahulu
                allRows.forEach(row => row.style.display = "none");

                // Tampilkan hanya sejumlah maxRows baris
                allRows.slice(0, maxRows).forEach(row => row.style.display = "");
            }
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
    </script>
 </body>
</html>
</x-layout-admin>