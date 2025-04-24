<x-layout-admin>
    <x-slot name="header"></x-slot>

    <div class="max-w-4xl mx-auto mt-10">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-6">Ubah Data Tahun Ajaran</h2>

            <form action="{{ route('admin.updateTahunAjaran', $tahunajaran->id) }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <!-- Tahun Ajaran -->
                    <div class="flex items-center">
                        <label class="w-1/3 text-sm font-medium text-gray-700">Tahun Ajaran:</label>
                        <input class="w-2/3 p-2 border border-gray-300 rounded-md" type="text" name="tahun_ajaran" value="{{ $tahunajaran->tahun_ajaran }}" required />
                    </div>

                    <!-- Awal -->
                    <div class="flex items-center">
                        <label class="w-1/3 text-sm font-medium text-gray-700">Awal:</label>
                        <input class="w-2/3 p-2 border border-gray-300 rounded-md" type="date" name="awal" value="{{ $tahunajaran->awal }}" required />
                    </div>

                    <!-- Akhir -->
                    <div class="flex items-center">
                        <label class="w-1/3 text-sm font-medium text-gray-700">Akhir:</label>
                        <input class="w-2/3 p-2 border border-gray-300 rounded-md" type="date" name="akhir" value="{{ $tahunajaran->akhir }}" required />
                    </div>

                    <!-- Status -->
                    <div class="flex items-center">
                        <label class="w-1/3 text-sm font-medium text-gray-700">Status:</label>
                        <select class="w-2/3 p-2 border border-gray-300 rounded-md" name="status">
                            <option value="Aktif" {{ $tahunajaran->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Non Aktif" {{ $tahunajaran->status == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                        </select>
                    </div>
                </div>

                <!-- Button Kembali dan Perbarui -->
                <div class="flex justify-end mt-6 space-x-4">
                    <a href="{{ route('admin.manage-tahun-ajaran') }}">
                        <button class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-700" type="button">Kembali</button>
                    </a>

                    <button class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-700" type="submit">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>
