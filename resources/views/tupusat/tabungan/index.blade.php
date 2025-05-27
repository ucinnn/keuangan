<x-layout-tupusat>
    <x-slot name="header"></x-slot>

    <div class="flex h-screen bg-gray-100">
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
              <div class="text-2xl font-bold text-gray-800">Daftar Tabungan Siswa</div>
              <div class="flex space-x-2">
                 <a href="{{ route('tupusat.tabungan.index') }}"
                    class="bg-blue-400 text-white px-4 py-2 rounded flex items-center hover:bg-blue-500">
                      <i class="fas fa-file-export mr-2"></i> Data Tabungan
                  </a>
                  <a href="{{ route('tupusat.tabungan.export.all') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded flex items-center hover:bg-blue-700">
                      <i class="fas fa-file-export mr-2"></i> Export Excel
                  </a>
                  <a href="{{ route('tupusat.tabungan.create') }}"
                    class="bg-green-500 text-white px-4 py-2 rounded flex items-center hover:bg-green-600">
                      <i class="fas fa-plus mr-2"></i> Tambah Tabungan
                  </a>
                  <a href="{{ route('tupusat.tabungan.index', ['trashed' => true]) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                      <i class="fas fa-trash-restore mr-1"></i> Data Terhapus
                  </a>
              </div>
            </div>

<!-- Form Pencarian dan Filter -->
<div class="mb-4 flex justify-between items-center">
    <form action="{{ route('tupusat.tabungan.index') }}" method="GET" class="flex flex-wrap gap-2 items-center">
        <input type="text" name="search" value="{{ request()->get('search') }}" 
               class="border border-gray-300 rounded px-4 py-2 w-64" placeholder="Cari nama siswa...">

        <select name="unit" class="border border-gray-300 rounded px-4 py-2">
            <option value="">Semua Unit</option>
            @foreach ($units as $unit)
                <option value="{{ $unit->id }}" {{ request('unit') == $unit->id ? 'selected' : '' }}>
                    {{ $unit->namaUnit }}
                </option>
            @endforeach
        </select>

        <select name="kelas" class="border border-gray-300 rounded px-4 py-2">
            <option value="">Semua Kelas</option>
            @foreach ($kelasList as $kelas)
                <option value="{{ $kelas->id }}" {{ request('kelas') == $kelas->id ? 'selected' : '' }}>
                    {{ $kelas->nama_kelas }}
                </option>
            @endforeach
        </select>

        <select name="status" class="border border-gray-300 rounded px-4 py-2">
            <option value="">Status Tabungan</option>
            <option value="Aktif" {{ request()->get('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Non Aktif" {{ request()->get('status') == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
        </select>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Filter</button>
    </form>
</div>


            <!-- Konten -->
            <div class="bg-white p-4 rounded shadow">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        <strong>Sukses!</strong> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <strong>Error!</strong> {{ session('error') }}
                    </div>
                @endif

                <!-- Tabel -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead class="bg-green-500 text-white text-sm text-center">
                            <tr>
                                <th class="py-2 px-4 border-r">No</th>
                                <th class="py-2 px-4 border-r">Nama Siswa</th>
                                <th class="py-2 px-4 border-r">Unit</th>
                                <th class="py-2 px-4 border-r">Kelas</th>
                                <th class="py-2 px-4 border-r">Saldo Awal</th>
                                <th class="py-2 px-4 border-r">Saldo Akhir</th>
                                @if(request()->get('trashed'))
                                <th class="py-2 px-4 border-r">Deleted By</th>
                                @endif
                                <th class="py-2 px-4 border-r">Status</th>
                                <th class="py-2 px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center text-gray-700 text-sm">
                            @forelse ($tabungans as $index => $tabungan)
                                <tr class="border-t border-gray-200">
                                    <td class="py-2 px-4 border-r">{{ $tabungans->firstItem() + $index }}</td>
                                    <td class="py-2 px-4 border-r">{{ $tabungan->siswa->nama }}</td>
                                    <td class="py-2 px-4 border-r">{{ $tabungan->siswa->kelas->unitpendidikan->namaUnit ?? '-' }}</td>
                                    <td class="py-2 px-4 border-r">{{ $tabungan->siswa->kelas->nama_kelas ?? '-' }}</td>
                                    <td class="py-2 px-4 border-r">Rp {{ number_format($tabungan->saldo_awal, 0, ',', '.') }}</td>
                                    <td class="py-2 px-4 border-r">Rp {{ number_format($tabungan->saldo_akhir, 0, ',', '.') }}</td>
                                    @if(request()->get('trashed'))
                                    <td class="py-2 px-4 border-b">{{ $tabungan->user->username }}</td>
                                    @endif
                                    <td class="py-2 px-4 border-r">
                                        @php
                                            $statusColor = match($tabungan->status) {
                                                'Aktif' => 'green',
                                                'Non Aktif' => 'red',
                                                default => 'gray'
                                            };
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-semibold text-{{ $statusColor }}-700 bg-{{ $statusColor }}-100 rounded-full">
                                            {{ $tabungan->status }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-4">
                                    @if(request()->get('trashed'))
                                      <form action="{{ route('tupusat.tabungan.restore', $tabungan->id) }}" method="POST" class="inline">
                                          @csrf
                                          <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded text-xs hover:bg-yellow-600 transition">
                                              <i class="fas fa-undo mr-1"></i> Restore
                                          </button>
                                      </form>
                                           <form action="{{ route('tupusat.tabungan.forceDelete', $tabungan->id) }}" method="POST" onsubmit="return confirm('Hapus permanen?, Anda akan kehilangan data selamanya jika melakukan ini')" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                          <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-800 transition">
                                              <i class="fas fa-trash mr-1"></i> Hapus Permanen
                                                </button>
                                            </form>
                                  @else
                                      <a href="{{ route('tabungan.show', $tabungan->id) }}"
                                        class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600 transition">
                                          <i class="fas fa-eye mr-1"></i> Detail
                                      </a>

                                      <form action="{{ route('tupusat.tabungan.destroy', $tabungan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tabungan ini?')" class="inline">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600 transition">
                                              <i class="fas fa-trash mr-1"></i> Hapus
                                          </button>
                                      </form>
                                  @endif
                              </td>
                          </tr>
                      @empty
                                <tr>
                                    @if(request()->get('trashed'))
                                    <td colspan="9" class="py-4 text-center text-gray-500">Tidak ada data tabungan.</td>
                                    @else
                                    <td colspan="8" class="py-4 text-center text-gray-500">Tidak ada data tabungan.</td>
                                    @endif
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $tabungans->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout-tupusat>
