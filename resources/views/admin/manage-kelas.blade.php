<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<x-layout-admin>
    <x-slot name="header">
        <!-- Anda dapat menambahkan konten header di sini jika diperlukan -->
    </x-slot>
    
    <div class="bg-gray-100 p-6">
        <div class="container mx-auto px-6">
            <h1 class="text-2xl font-semibold mb-4">Manajemen Data Kelas</h1>
            <div class="flex flex-wrap items-center mb-4">
                <div class="flex space-x-2 mb-2 md:mb-0">
                    <!-- Filter Nama Unit -->
                    <select id="filter-nama-unit" class="border border-gray-300 rounded px-3 py-2 text-sm">
                        <option value="">Pilih Nama Unit</option>
                        <option value="-">-</option>
                        <option value="TK">TK</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="TPQ">TPQ</option>
                        <option value="PONDOK">PONDOK</option>
                        <option value="MADIN">MADIN</option>
                    </select>

                    <!-- Input teks untuk filter nama_kelas -->
                    <input type="text" id="nama_kelas_filter" class="block w-full p-3 border border-gray-300 rounded-lg text-sm" placeholder="Cari Kelas">

                    <!-- Filter Grade -->
                    <select id="filter-grade" class="border border-gray-300 rounded px-3 py-2 text-sm">
                        <option value="">Pilih Grade</option>
                        <option value="-">-</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                    </select>

                    <!-- Filter Status -->
                    <select id="filter-status" class="border border-gray-300 rounded px-3 py-2 text-sm">
                        <option value="">Pilih Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                    <button id="filter-button" class="bg-yellow-500 text-white px-4 py-2 rounded text-sm">Tampilkan</button>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('admin.create-kelas') }}">
                        <x-primary-button class="ms-3 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            {{ __('Tambah Kelas') }}
                        </x-primary-button>
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-green-500 text-white">
                        <tr>
                            <th class="py-2 px-4 border-b text-left">No.</th>
                            <th class="py-2 px-4 border-b text-left">Unit Pendidikan</th>
                            <th class="py-2 px-4 border-b text-left">Kelas</th>
                            <th class="py-2 px-4 border-b text-left">Grade</th>
                            <th class="py-2 px-4 border-b text-left">Keterangan</th>
                            <th class="py-2 px-4 border-b text-left">Status</th>
                            <th class="py-2 px-4 border-b text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="kelasTable">
                        @foreach ($kelas as $itemm)
                            <tr class="user-row hover:bg-gray-50" data-role="{{ strtolower($itemm->role) }}">
                                <td class="border border-gray-300 px-1 py-0.5 text-center text-xs">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $itemm->unitpendidikan->namaUnit }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $itemm->nama_kelas }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $itemm->grade }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $itemm->keterangan }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $itemm->status }}</td>
                                <td class="py-2 px-4 border-b text-left">
                                    <a href="{{ route('admin.edit-kelas', $itemm->id) }}" class="bg-yellow-500 text-white p-1 rounded-full hover:bg-yellow-600 transition">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="flex items-center justify-between mt-4">
                    <div>Showing .... to ... of ... entries</div>
                    <div class="flex items-center space-x-2">
                        <button class="bg-gray-200 text-gray-700 px-3 py-1 rounded">Previous</button>
                        <span>1</span>
                        <button class="bg-gray-200 text-gray-700 px-3 py-1 rounded">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const namaUnitFilter = document.getElementById("filter-nama-unit");
            const namaKelasFilter = document.getElementById("nama_kelas_filter");
            const gradeFilter = document.getElementById("filter-grade");
            const statusFilter = document.getElementById("filter-status");
            const filterButton = document.getElementById("filter-button");
            const tableRows = document.querySelectorAll("tbody tr");

            function filterTable() {
                const unitValue = namaUnitFilter.value.toLowerCase();
                const kelasValue = namaKelasFilter.value.toLowerCase();
                const gradeValue = gradeFilter.value.toLowerCase();
                const statusValue = statusFilter.value.toLowerCase();

                tableRows.forEach(row => {
                    const unitText = row.cells[1].innerText.toLowerCase(); // Kolom Nama Unit
                    const kelasText = row.cells[2].innerText.toLowerCase(); // Kolom Nama Kelas
                    const gradeText = row.cells[3].innerText.toLowerCase(); // Kolom Grade
                    const statusText = row.cells[5].innerText.toLowerCase(); // Kolom Status

                    if (
                        (unitValue === "" || unitText.includes(unitValue)) &&
                        (kelasValue === "" || kelasText.includes(kelasValue)) &&
                        (gradeValue === "" || gradeText.includes(gradeValue)) &&
                        (statusValue === "" || statusText.includes(statusValue))
                    ) {
                        row.style.display = ""; // Tampilkan baris
                    } else {
                        row.style.display = "none"; // Sembunyikan baris
                    }
                });
            }

            // Event listeners untuk filter
            namaUnitFilter.addEventListener("change", filterTable);
            namaKelasFilter.addEventListener("input", filterTable);
            gradeFilter.addEventListener("change", filterTable);
            statusFilter.addEventListener("change", filterTable);
            filterButton.addEventListener("click", filterTable);
        });
    </script>
</x-layout-admin>
