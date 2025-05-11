<x-layout-admin>
    <x-slot name="header"></x-slot>
        <!-- Pesan Notifikasi -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Konten halaman -->
        <html lang="en">
            <head>
                <meta charset="utf-8" />
                <meta content="width=device-width, initial-scale=1.0" name="viewport" />
                <title>Manajemen Data Siswa</title>
                <script src="https://cdn.tailwindcss.com"></script>
                <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
            </head>
            <body class="bg-gray-100">
                <div class="flex h-screen">
                    <!-- Main Content -->
                    <div class="flex-1 p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div class="text-2xl font-bold">Manajemen Data Siswa</div>
                        </div>
                        <div class="bg-white p-4 rounded shadow">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center space-x-4">
                                    <form method="GET" action="{{ route('admin.manage-data-siswa') }}" class="flex items-center space-x-4">
                                        <!-- Filter Kelas -->
                                        <select name="kelas_id" class="border border-gray-300 rounded p-2">
                                            <option value="">Pilih Kelas</option>
                                            @foreach($kelas as $data)
                                                <option value="{{ $data->id }}" {{ request('kelas_id') == $data->id ? 'selected' : '' }}>{{ $data->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                        <!-- Filter Status -->
                                        <select name="status" class="border border-gray-300 rounded p-2">
                                            <option value="Pilih Status" {{ request('status') == 'Pilih Status' ? 'selected' : '' }}>Pilih Status</option>
                                            <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="Non Aktif" {{ request('status') == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                                            <option value="Drop Out" {{ request('status') == 'Drop Out' ? 'selected' : '' }}>Drop Out</option>
                                            <option value="Pindah" {{ request('status') == 'Pindah' ? 'selected' : '' }}>Pindah</option>
                                            <option value="Lulus" {{ request('status') == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                                        </select>
                                        <!-- Tombol Tampilkan -->
                                        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Tampilkan</button>
                                    </form>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <x-primary-button class="bg-green-500 text-white px-4 py-2 rounded flex items-center" onclick="toggleModal('importModal')">
                                        <i class="fas fa-file-import mr-2"></i>
                                        {{ __('Import Data Siswa') }}
                                    </x-primary-button>
                                    <a href="{{ route('admin.create-data-siswa') }}">
                                        <x-primary-button class="bg-green-500 text-white px-4 py-2 rounded flex items-center">
                                            <i class="fas fa-plus mr-2"></i>
                                            {{ __('Tambah Data') }}
                                        </x-primary-button>
                                    </a>
                                </div>
                            </div>
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center space-x-2">
                                    <label class="text-sm" for="entries">Show</label>
                                    <select class="border border-gray-300 rounded p-2" id="entries">
                                    <option>10</option>
                                    <option>20</option>
                                    <option>30</option>
                                    <option>40</option>
                                    <option>50</option>
                                    </select>
                                    <label class="text-sm" for="entries">entries</label>
                                </div>

                            <form method="GET" action="{{ route('admin.manage-data-siswa') }}" class="flex items-center space-x-2 w-full max-w-lg">
                                <label class="text-sm" for="search">Cari :</label>
                                <input
                                    class="border border-gray-300 rounded p-2 flex-grow"
                                    id="search"
                                    name="search"
                                    type="text"
                                    placeholder="Cari Nama atau NIS"
                                    value="{{ request('search') }}"
                                    oninput="handleSearchInput()"
                                />
                                <button class="bg-blue-500 text-white px-4 py-2 rounded">Cari</button>
                            </form>
                        </div>

                            <!-- Modal Import Data -->
                            <div id="importModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center">
                                <div class="bg-white w-1/3 rounded-lg shadow-lg p-6">
                                    <div class="flex justify-between items-center mb-4">
                                        <h2 class="text-lg font-bold">Import Data Siswa</h2>
                                        <button onclick="toggleModal('importModal')" class="text-gray-500">&times;</button>
                                    </div>
                                    <form action="{{ route('admin.import-data-siswa') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Pilih File</label>
                                            <input
                                                type="file"
                                                id="file"
                                                name="file"
                                                accept=".xlsx,.xls,.csv"
                                                class="border border-gray-300 rounded p-2 w-full"
                                                required
                                            />
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="button" onclick="toggleModal('importModal')" class="bg-red-500 text-white px-4 py-2 rounded">Batal</button>
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded ml-2">Import</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <script>
                                function toggleModal(id) {
                                    const modal = document.getElementById(id);
                                    if (modal.classList.contains('hidden')) {
                                        modal.classList.remove('hidden');
                                        modal.classList.add('flex');
                                    } else {
                                        modal.classList.add('hidden');
                                        modal.classList.remove('flex');
                                    }
                                }
                            </script>

                            <!-- Table Data Siswa -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-gray-300">
                                    <tr class="bg-green-500 text-white text-center">
                                        <th class="py-2 px-4 border-r border-gray-300">No.</th>
                                        <th class="py-2 px-4 border-r border-gray-300">NIS</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Nama Siswa</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Jenis Kelamin</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Kelas</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Status</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Aksi</th>
                                    </tr>
                                    @foreach ($siswas as $no=>$data)
                                    <tr class="bg-white text-black text-center border-b border-gray-300">
                                        <td class="py-2 px-4 border-r border-gray-300">{{ $no+1 }}</td>
                                        <td class="py-2 px-4 border-r border-gray-300">{{ $data->nis }}</td>
                                        <td class="py-2 px-4 border-r border-gray-300">{{ $data->nama }}</td>
                                        <td class="py-2 px-4 border-r border-gray-300">{{ $data->jenis_kelamin }}</td>
                                        <td class="py-2 px-4 border-r border-gray-300">{{ $data->kelas->nama_kelas}}</td>
                                        <td class="py-2 px-4 border-r border-gray-300">{{ $data->status }}</td>
                                        <td class="flex justify-center space-x-2 py-2">
                                            <a href="{{ route('admin.detail-data-siswa', $data->id) }}">
                                                <button class="bg-green-500 text-white px-4 py-2 rounded">Detail</button>
                                            </a>
                                            <a href="{{ route('admin.edit-data-siswa', $data->id) }}">
                                                <button class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function handleSearchInput() {
                        const searchInput = document.getElementById('search');
                        if (searchInput.value.trim() === '') {
                            const url = new URL(window.location.href);
                            url.searchParams.delete('search');
                            window.location.href = url.toString();
                        }
                    }
                </script>
            </body>
        </html>
</x-layout-admin>
