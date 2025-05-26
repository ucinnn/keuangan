<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<x-layout-tupusat>
    <x-slot name="header">

    </x-slot>

    <div class="max-w-3xl mx-auto mt-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-bold mb-6 text-gray-800">Tambah Tabungan Siswa</h3>

                <form action="{{ route('tabungan.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Pilih Siswa -->
                    <div class="flex items-center space-x-4">
                        <label for="siswa_id" class="text-sm font-medium text-gray-700 w-1/4">Pilih Siswa</label>
                        <select name="siswa_id" id="siswa_id" class="w-3/4 px-4 py-2 border rounded-md focus:ring focus:ring-green-300" required>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Saldo Awal -->
                    <div class="flex items-center space-x-4">
                        <label for="saldo_awal" class="text-sm font-medium text-gray-700 w-1/4">Saldo Awal</label>
                        <input type="number" name="saldo_awal" id="saldo_awal" min="0" class="w-3/4 px-4 py-2 border rounded-md focus:ring focus:ring-green-300" required>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end space-x-4 pt-4">
                        <a href="{{ url( route('tupusat.tabungan.index')) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Kembali</a>
                        <button type="reset" class="bg-orange-500 text-white px-4 py-2 rounded-md hover:bg-orange-600">Reset</button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
</x-layout-tupusat>
