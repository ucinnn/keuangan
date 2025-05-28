<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<x-layout-tupusat>
    <x-slot name="header"></x-slot>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
        {{ session('success') }}
    </div>
@endif

    <!-- Notification Error -->
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-semibold text-center mb-6">Daftar Kas dan Transaksi Kas</h1>

        <!-- Daftar Kas -->
        <div class="card bg-white shadow-md rounded-lg mb-6 p-4">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h4 class="text-xl font-medium">Daftar Kas</h4>
            </div>
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left text-sm text-gray-700">No</th>
                        <th class="px-4 py-2 text-left text-sm text-gray-700">Nama Kas</th>
                        <th class="px-4 py-2 text-left text-sm text-gray-700">Kategori</th>
                        <th class="px-4 py-2 text-left text-sm text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kas as $key => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $key + 1 }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $item->namaKas }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $item->kategori }}</td>
                        <td class="px-4 py-2 text-sm">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $item->status == 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

                <!-- Tombol Tambah & Transaksi Dihapus -->
                <div class="text-center mb-4 space-x-2">
                    <a href="{{ route('tupusat.kas.create') }}" class="bg-green-500 text-white py-2 px-6 rounded-lg hover:bg-green-600 transition duration-300">Tambah Transaksi Kas</a>
                    <a href="{{ route('tupusat.kas.trashed') }}" class="bg-yellow-500 text-white py-2 px-6 rounded-lg hover:bg-yellow-600 transition duration-300">Transaksi Dihapus</a>
                </div>

        <!-- Daftar Transaksi Kas -->
        <div class="card bg-white shadow-md rounded-lg mb-6 p-4">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h4 class="text-xl font-medium">Daftar Transaksi Kas</h4>
            </div>
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left text-sm text-gray-700">No</th>
                        <th class="px-4 py-2 text-left text-sm text-gray-700">Nama Kas</th>
                        <th class="px-4 py-2 text-left text-sm text-gray-700">Tipe</th>
                        <th class="px-4 py-2 text-left text-sm text-gray-700">Nominal</th>
                        <th class="px-4 py-2 text-left text-sm text-gray-700">Unit Pendidikan</th>
                        <th class="px-4 py-2 text-left text-sm text-gray-700">Created By</th>
                        <th class="px-4 py-2 text-left text-sm text-gray-700">Keterangan</th>
                        <th class="px-4 py-2 text-left text-sm text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksiKas as $key => $transaksi)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $key + 1 }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $transaksi->kas ? $transaksi->kas->namaKas : 'Kas tidak ditemukan' }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $transaksi->tipe }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">Rp. {{ number_format($transaksi->nominal, 2, ',', '.') }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $transaksi->unitpendidikan->namaUnit }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $transaksi->created_by }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $transaksi->keterangan }}</td>
                        <td class="px-4 py-2 text-sm">
                              <a href="{{ route('tupusat.kas.edit', $transaksi->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a> |
                          <form action="{{ route('tupusat.kas.destroy', $transaksi->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus?')">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                          </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-layout-tupusat>
