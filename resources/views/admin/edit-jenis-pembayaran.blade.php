<x-layout-admin>
    <x-slot name="header">

    </x-slot>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>
            Manajemen Data Jenis Pembayaran
        </title>
        <script src="https://cdn.tailwindcss.com">
        </script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    </head>

    <body class="bg-gray-100">
        <div class="flex flex-col h-screen">
            <!-- Main Content -->
            <div class="flex-1 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">
                        Manajemen Data Jenis Pembayaran
                    </h2>
                    <div class="flex items-center">
                        <p class="mr-4">
                    </div>
                </div>
                <div class="bg-white p-6 rounded shadow-md">
                    <h2 class="text-xl font-bold mb-4 bg-green-500 text-white p-2 rounded">
                        Ubah Data Jenis Pembayaran
                    </h2>
                    <form
                        action="{{ route('admin.update-jenis-pembayaran', ['id' => $jenispembayaran->idjenispembayaran]) }}"
                        method="POST" class="space-y-4">
                        @csrf
                        @method('POST') <!-- Diperbaiki agar sesuai dengan metode POST -->

                        <div class="grid grid-cols-1 gap-4">
                            <!-- Nama Pembayaran -->
                            <div class="flex items-center">
                                <label for="nama_pembayaran" class="w-1/4">Nama Pembayaran</label>
                                <input type="text" id="nama_pembayaran" name="nama_pembayaran"
                                    value="{{ old('nama_pembayaran', $jenispembayaran->nama_pembayaran) }}"
                                    class="w-3/4 p-2 border rounded" required />
                            </div>

                            <!-- Tipe Pembayaran -->
                            <div class="flex items-center">
                                <label class="w-1/4" for="type">Tipe Pembayaran</label>
                                <select class="w-3/4 p-2 border rounded" id="type" name="type" required>
                                    <option value="">Pilih Tipe Pembayaran</option>
                                    <option value="Bulanan" {{ old('type', $jenispembayaran->type) == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                                    <option value="Semester" {{ old('type', $jenispembayaran->type) == 'Semester' ? 'selected' : '' }}>Semester</option>
                                    <option value="Tahunan" {{ old('type', $jenispembayaran->type) == 'Tahunan' ? 'selected' : '' }}>Tahunan</option>
                                    <option value="Bebas" {{ old('type', $jenispembayaran->type) == 'Bebas' ? 'selected' : '' }}>Bebas</option>
                                </select>
                            </div>

                            <!-- Tahun -->
                            <div class="flex items-center">
                                <label class="w-1/4" for="tahun">Tahun Ajaran</label>
                                <select class="w-3/4 p-2 border rounded" id="tahun" name="id_tahunajaran" required>
                                    <option value="">Pilih Tahun Ajaran</option>
                                    @foreach ($tahunAjaran as $tahun)
                                        <option value="{{ $tahun->id }}" {{ old('id_tahunajaran', $jenispembayaran->id_tahunajaran) == $tahun->id ? 'selected' : '' }}>
                                            {{ $tahun->tahun_ajaran }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- Nominal -->
                            <div class="flex items-center">
                                <label class="w-1/4" for="nominal_jenispembayaran">Nominal</label>
                                <input class="w-3/4 p-2 border rounded" id="nominal_jenispembayaran"
                                    name="nominal_jenispembayaran" type="text"
                                    value="{{ old('nominal_jenispembayaran', $jenispembayaran->nominal_jenispembayaran) }}"
                                    required />
                            </div>
                            <div class="flex items-center">
                                <label class="w-1/4">Status</label>
                                <select class="w-3/4 p-2 border rounded" name="status" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="Aktif" {{ $jenispembayaran->status == 'Aktif' ? 'selected' : '' }}>
                                        Aktif</option>
                                    <option value="Non Aktif" {{ $jenispembayaran->status == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                                </select>
                            </div>
                            <div class="flex items-center">
                                <label class="w-1/4" for="idunitpendidikan">Unit</label>
                                <select class="w-3/4 p-2 border rounded" id="idunitpendidikan" name="idunitpendidikan">
                                    @foreach($unitpendidikan as $unit)
                                        <option value="{{ $unit->id }}" {{ $jenispembayaran->idunitpendidikan == $unit->id ? 'selected' : '' }}>
                                            {{ $unit->namaUnit }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="flex justify-end mt-4">
                                <a href="{{ route('admin.manage-jenis-pembayaran') }}">
                                    <button class="bg-red-500 text-white px-4 py-2 rounded mr-2" type="button">
                                        Kembali
                                    </button>
                                </a>
                                <a href="{{ route('admin.manage-jenis-pembayaran') }}">
                                    <button class="bg-green-500 text-white px-4 py-2 rounded"
                                        type="submit">Perbarui</button>
                                </a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>
</x-layout-admin>