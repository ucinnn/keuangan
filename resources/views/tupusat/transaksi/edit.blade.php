<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<x-layout-tupusat>
    <x-slot name="header"></x-slot>

    <div class="max-w-2xl mx-auto mt-10 px-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">
                Edit Transaksi untuk: <span class="text-green-600">{{ $transaksi->tabungan->siswa->nama }}</span>
            </h3>

            <form action="{{ route('tupusat.transaksi.update', $transaksi->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Jenis Transaksi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Transaksi</label>
                    <select name="jenis_transaksi"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-300"
                            required>
                        <option value="Setoran" {{ $transaksi->jenis_transaksi == 'Setoran' ? 'selected' : '' }}>Setoran</option>
                        <option value="Penarikan" {{ $transaksi->jenis_transaksi == 'Penarikan' ? 'selected' : '' }}>Penarikan</option>
                    </select>
                </div>

                <!-- Jumlah -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                    <input type="number" name="jumlah" required value="{{ $transaksi->jumlah }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-300">
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" required value="{{ $transaksi->tanggal }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-300">
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                    <textarea name="keterangan"
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-green-300"
                              rows="3">{{ $transaksi->keterangan }}</textarea>
                </div>

                <!-- Tombol Update -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                        Update Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout-tupusat>
