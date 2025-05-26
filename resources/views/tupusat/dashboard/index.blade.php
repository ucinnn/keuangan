<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<x-layout-tupusat>
<x-slot name="header">

</x-slot>

    <div class="max-w-5xl mx-auto mt-10 px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Statistik Siswa Aktif -->
            <div class="p-6 bg-white border-l-4 border-green-500 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800">Jumlah Siswa Aktif</h3>
                <p class="text-3xl font-bold text-green-700">{{ $siswaAktif }}</p>
            </div>
            
            <!-- Statistik Total Saldo Awal Tabungan -->
            <div class="p-6 bg-white border-l-4 border-blue-500 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800">Total Saldo Awal Tabungan</h3>
                <p class="text-3xl font-bold text-blue-700">Rp {{ number_format($totalSaldoAwal, 0, ',', '.') }}</p>
            </div>

            <!-- Statistik Total Saldo Akhir Tabungan -->
            <div class="p-6 bg-white border-l-4 border-purple-500 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800">Total Saldo Akhir Tabungan</h3>
                <p class="text-3xl font-bold text-purple-700">Rp {{ number_format($totalSaldoAkhir, 0, ',', '.') }}</p>
            </div>

            <!-- Statistik Unit Pendidikan Aktif -->
            <div class="p-6 bg-white border-l-4 border-yellow-500 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-800">Jumlah Unit Pendidikan Aktif</h3>
                <p class="text-3xl font-bold text-yellow-700">{{ $totalUnit }}</p>
            </div>
        </div>

            <!-- Grafik Transaksi per Bulan -->
            <div class="p-6 bg-white rounded-lg shadow-md mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Grafik Transaksi Setoran vs Penarikan per Bulan</h3>
                <canvas id="transaksiChart"></canvas>
            </div>

        <!-- Statistik Siswa per Unit Pendidikan -->
        <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Jumlah Siswa Aktif per Unit Pendidikan</h3>
            <table class="min-w-full bg-white border border-gray-200 text-sm rounded-lg shadow-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-3 px-4 border-b">Unit Pendidikan</th>
                        <th class="py-3 px-4 border-b">Jumlah Siswa Aktif</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswaPerUnit as $unit)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $unit->unitpendidikan->namaUnit }}</td>
                            <td class="py-2 px-4 border-b">{{ $unit->total_siswa }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script>
        var ctx = document.getElementById('transaksiChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels), // data bulan
                datasets: [{
                    label: 'Setoran',
                    data: @json($setoranDataFormatted),  // Menggunakan setoranDataFormatted
                    backgroundColor: 'rgba(40,167,69,0.6)',
                    borderColor: 'rgba(40,167,69,1)',
                    borderWidth: 1
                }, {
                    label: 'Penarikan',
                    data: @json($penarikanDataFormatted), // Menggunakan penarikanDataFormatted
                    backgroundColor: 'rgba(255,99,132,0.6)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Bulan'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah (Rp)'
                        }
                    }
                }
            }
        });
    </script>

</x-layout-tupusat>
