<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<x-layout-tupusat>
    <x-slot name="header"></x-slot>

    <div class="max-w-5xl mx-auto mt-10 px-6">
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">
                Detail Tabungan: <span class="text-green-600">{{ $tabungan->siswa->nama }}</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="p-4 bg-green-50 border-l-4 border-green-400 rounded">
                    <p class="text-gray-600 text-sm">Saldo Awal</p>
                    <p class="text-lg font-semibold text-green-800">
                        Rp {{ number_format($tabungan->saldo_awal, 0, ',', '.') }}
                    </p>
                </div>
                <div class="p-4 bg-blue-50 border-l-4 border-blue-400 rounded">
                    <p class="text-gray-600 text-sm">Saldo Akhir</p>
                    <p class="text-lg font-semibold text-blue-800">
                        Rp {{ number_format($tabungan->saldo_akhir, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <div class="flex justify-end mb-4 space-x-2">
                <a href="{{ url( route('tupusat.tabungan.index')) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Kembali</a>
                <a href="{{ route('tupusat.transaksi.create', $tabungan->id) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition duration-200">
                    Tambah Transaksi
                </a>
                <a href="{{ route('tupusat.tabungan.export.pdf', $tabungan->id) }}"
                   class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded transition duration-200">
                    Export PDF
                </a>
            </div>

            <!-- Grafik -->
            <div class="my-6">
                <h5 class="text-lg font-semibold text-gray-700 mb-3">Grafik Transaksi per Bulan</h5>
                <canvas id="transaksiChart" height="100"></canvas>
            </div>

            <!-- Filter Tanggal -->
            <form method="GET" class="flex items-center gap-2 mb-4">
                <label class="text-sm text-gray-700">Periode:</label>
                <input type="date" name="start" value="{{ request('start') }}"
                       class="border px-2 py-1 rounded">
                <span class="text-gray-600">s/d</span>
                <input type="date" name="end" value="{{ request('end') }}"
                       class="border px-2 py-1 rounded">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                    Terapkan
                </button>
                @if(request()->has('start') || request()->has('end'))
                    <a href="{{ route('tabungan.show', $tabungan->id) }}"
                       class="text-sm text-blue-600 underline ml-2">
                        Reset
                    </a>
                @endif
            </form>

            <h5 class="text-lg font-semibold text-gray-700 mb-3">Riwayat Transaksi</h5>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 text-sm rounded-lg shadow-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="py-3 px-4 border-b">Tanggal</th>
                            <th class="py-3 px-4 border-b">Jenis</th>
                            <th class="py-3 px-4 border-b">Jumlah</th>
                            <th class="py-3 px-4 border-b">Keterangan</th>
                            <th class="py-3 px-4 border-b">Petugas</th>
                            <th class="py-3 px-4 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksi as $trx)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b">{{ $trx->tanggal }}</td>
                                <td class="py-2 px-4 border-b">{{ $trx->jenis_transaksi }}</td>
                                <td class="py-2 px-4 border-b text-green-700">
                                    Rp {{ number_format($trx->jumlah, 0, ',', '.') }}
                                </td>
                                <td class="py-2 px-4 border-b">{{ $trx->keterangan }}</td>
                                <td class="py-2 px-4 border-b">{{ $trx->user->username }}</td>
                                <td class="py-2 px-4 border-b text-center whitespace-nowrap">
                                    <a href="{{ route('tupusat.transaksi.edit', $trx->id) }}"
                                       class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 text-xs rounded mr-1">
                                        Edit
                                    </a>
                                    <form action="{{ route('tupusat.transaksi.destroy', $trx->id) }}" method="POST"
                                          class="inline-block"
                                          onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 text-xs rounded">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-500">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Grafik Chart.js -->
    <script>
        const ctx = document.getElementById('transaksiChart').getContext('2d');
        const transaksiChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartData->pluck('bulan')) !!},
                datasets: [
                    {
                        label: 'Setoran',
                        backgroundColor: 'rgba(34,197,94,0.7)',
                        data: {!! json_encode($chartData->pluck('total_setoran')) !!}
                    },
                    {
                        label: 'Penarikan',
                        backgroundColor: 'rgba(239,68,68,0.7)',
                        data: {!! json_encode($chartData->pluck('total_penarikan')) !!}
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-layout-tupusat>