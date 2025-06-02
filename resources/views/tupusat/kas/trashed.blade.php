<x-layout-tupusat>
    <x-slot name="header"></x-slot>

    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Transaksi Kas yang Dihapus</h1>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full table-auto bg-white shadow-md rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm text-gray-700">Nama Kas</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-700">Nominal</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-700">Unit Pendidikan</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-700">Deleted by</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-700">Deleted At</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trashedTransaksiKas as $transaksi)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $transaksi->kas->namaKas ?? 'Kas tidak ditemukan' }}</td>
                    <td class="px-4 py-2">Rp. {{ number_format($transaksi->nominal, 2, ',', '.') }}</td>
                    <td class="px-4 py-2">{{ $transaksi->unitpendidikan->namaUnit }}</td>
                    <td class="px-4 py-2">{{ $transaksi->deleted_by }}</td>
                    <td class="px-4 py-2">{{ $transaksi->deleted_at->translatedFormat('d F Y h:i A') }}</td>
                    <td class="px-4 py-2">
                        <form action="{{ route('tupusat.kas.restore', $transaksi->id) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="text-blue-500 hover:text-blue-700">Restore</button>
                        </form>
                        
                        {{-- <form action="{{ route('tupusat.kas.forceDelete', $transaksi->id) }}" method="POST" onsubmit="return confirm('Hapus permanen?')" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Hapus Permanen</button>
                        </form> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            <a href="{{ route('tupusat.kas.index') }}" class="text-blue-600 hover:underline">← Kembali ke daftar transaksi</a>
        </div>
    </div>
</x-layout-tupusat>
