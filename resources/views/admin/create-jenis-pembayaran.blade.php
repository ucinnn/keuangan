<x-layout-admin>
    <x-slot name="header"></x-slot>

    <div class="max-w-4xl mx-auto mt-10">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6">Tambah Jenis Pembayaran</h2>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            @if ($errors->any())
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: '{{ $errors->first() }}',
                    });
                </script>
            @endif

            <form method="POST" action="{{ route('admin.create-jenis-pembayaran-submit') }}" class="space-y-4">
                @csrf

                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700 w-1/4">Nama Pembayaran</label>
                    <input type="text" name="nama_pembayaran" class="w-3/4 p-2 border rounded-md focus:ring focus:ring-green-300" required>
                </div>

                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700 w-1/4">Tipe Pembayaran</label>
                    <select name="type" class="w-3/4 p-2 border rounded-md focus:ring focus:ring-green-300" required>
                        <option value="Bulanan">Bulanan</option>
                        <option value="Semester">Semester</option>
                        <option value="Tahunan">Tahunan</option>
                        <option value="Bebas">Bebas</option>
                    </select>
                </div>

                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700 w-1/4">Tahun Ajaran</label>
                    <select name="id_tahunajaran" class="w-3/4 p-2 border rounded-md focus:ring focus:ring-green-300" required>
                        @foreach ($tahunAjaran as $tahun)
                            <option value="{{ $tahun->id }}">{{ $tahun->tahun_ajaran }}/{{ $tahun->tahun_ajaran + 1 }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700 w-1/4">Nominal</label>
                    <input type="number" name="nominal_jenispembayaran" class="w-3/4 p-2 border rounded-md focus:ring focus:ring-green-300" required>
                </div>

                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700 w-1/4">Status</label>
                    <select class="w-3/4 p-2 border rounded-md bg-gray-100" name="status_display" disabled>
                        <option value="Aktif" selected>Aktif</option>
                    </select>
                    <input type="hidden" name="status" value="Aktif">
                </div>

                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700 w-1/4">Unit Pendidikan</label>
                    <select name="idunitpendidikan" class="w-3/4 p-2 border rounded-md focus:ring focus:ring-green-300" required>
                        @foreach ($unitpendidikan as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->namaUnit }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end mt-4 space-x-4">
                    <a href="{{ route('admin.manage-jenis-pembayaran') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Kembali</a>
                    <button type="reset" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Reset</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>
