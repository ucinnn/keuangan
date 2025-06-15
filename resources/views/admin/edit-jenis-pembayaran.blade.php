<x-layout-admin>
    <x-slot name="header"></x-slot>

    <div class="max-w-4xl mx-auto mt-10">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6">Edit Jenis Pembayaran</h2>

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
            
            <form method="POST" action="{{ route('admin.update-jenis-pembayaran', $jenispembayaran->id) }}" class="space-y-4">
                @csrf

                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700 w-1/4">Nama Pembayaran</label>
                    <input type="text" name="nama_pembayaran" value="{{ $jenispembayaran->nama_pembayaran }}" class="w-3/4 p-2 border rounded-md focus:ring focus:ring-green-300" required>
                </div>

                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700 w-1/4">Tipe Pembayaran</label>
                    <select name="type" class="w-3/4 p-2 border rounded-md focus:ring focus:ring-green-300" required>
                        <option value="Bulanan" {{ $jenispembayaran->type == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                        <option value="Semester" {{ $jenispembayaran->type == 'Semester' ? 'selected' : '' }}>Semester</option>
                        <option value="Tahunan" {{ $jenispembayaran->type == 'Tahunan' ? 'selected' : '' }}>Tahunan</option>
                        <option value="Bebas" {{ $jenispembayaran->type == 'Bebas' ? 'selected' : '' }}>Bebas</option>
                    </select>
                </div>

                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700 w-1/4">Tahun Ajaran</label>
                    <select name="id_tahunajaran" class="w-3/4 p-2 border rounded-md focus:ring focus:ring-green-300" required>
                        @foreach ($tahunAjaran as $tahun)
                            <option value="{{ $tahun->id }}" {{ $jenispembayaran->id_tahunajaran == $tahun->id ? 'selected' : '' }}>
                                {{ $tahun->tahun_ajaran }}/{{ $tahun->tahun_ajaran + 1 }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700 w-1/4">Nominal</label>
                    <input type="number" name="nominal_jenispembayaran" value="{{ $jenispembayaran->nominal_jenispembayaran }}" class="w-3/4 p-2 border rounded-md focus:ring focus:ring-green-300" required>
                </div>

                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700 w-1/4">Status</label>
                    <select name="status" class="w-3/4 p-2 border rounded-md focus:ring focus:ring-green-300" required>
                        <option value="Aktif" {{ $jenispembayaran->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Non Aktif" {{ $jenispembayaran->status == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                    </select>
                </div>

                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700 w-1/4">Unit Pendidikan</label>
                    <select name="idunitpendidikan" class="w-3/4 p-2 border rounded-md focus:ring focus:ring-green-300" required>
                        @foreach ($unitpendidikan as $unit)
                            <option value="{{ $unit->id }}" {{ $jenispembayaran->idunitpendidikan == $unit->id ? 'selected' : '' }}>
                                {{ $unit->namaUnit }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.manage-jenis-pembayaran') }}" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Batal</a>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</x-layout-admin>
