<x-layout-admin>
    <x-slot name="header">

    </x-slot>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>
            Manajemen Data Jenis pengeluaran
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
                        Manajemen Data Jenis pengeluaran
                    </h2>
                    <div class="flex items-center">
                        <p class="mr-4">
                    </div>
                </div>
                <div class="bg-white p-6 rounded shadow-md">
                    <h2 class="text-xl font-bold mb-4 bg-green-500 text-white p-2 rounded">
                        Ubah Data Jenis pengeluaran
                    </h2>
                    <form
                        action="{{ route('admin.update-jenis-pengeluaran', ['id' => $jenispengeluaran->id]) }}"
                        method="POST" class="space-y-4">
                        @csrf
                        @method('POST') <!-- Diperbaiki agar sesuai dengan metode POST -->

                        <div class="grid grid-cols-1 gap-4">
                            <!-- Nama pengeluaran -->
                            <div class="flex items-center">
                                <label for="nama_pengeluaran" class="w-1/4">Nama pengeluaran</label>
                                <input type="text" id="nama_pengeluaran" name="nama_pengeluaran"
                                    value="{{ old('nama_pengeluaran', $jenispengeluaran->nama_pengeluaran) }}"
                                    class="w-3/4 p-2 border rounded" required />
                            </div>

                            <!-- Tipe pengeluaran -->
                            <div class="flex items-center">
                                <label class="w-1/4" for="type">Tipe pengeluaran</label>
                                <select class="w-3/4 p-2 border rounded" id="type" name="type" required>
                                    <option value="">Pilih Tipe pengeluaran</option>
                                    <option value="Bulanan" {{ old('type', $jenispengeluaran->type) == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                                    <option value="Semester" {{ old('type', $jenispengeluaran->type) == 'Semester' ? 'selected' : '' }}>Semester</option>
                                    <option value="Tahunan" {{ old('type', $jenispengeluaran->type) == 'Tahunan' ? 'selected' : '' }}>Tahunan</option>
                                    <option value="Bebas" {{ old('type', $jenispengeluaran->type) == 'Bebas' ? 'selected' : '' }}>Bebas</option>
                                </select>
                            </div>

                            <!-- Tahun -->
                            <div class="flex items-center">
                                <label class="w-1/4" for="tahun">Tahun Ajaran</label>
                                <select class="w-3/4 p-2 border rounded" id="tahun" name="id_tahunajaran" required>
                                    <option value="">Pilih Tahun Ajaran</option>
                                    @foreach ($tahunAjaran as $tahun)
                                        <option value="{{ $tahun->id }}" {{ old('id_tahunajaran', $jenispengeluaran->id_tahunajaran) == $tahun->id ? 'selected' : '' }}>
                                            {{ $tahun->tahun_ajaran }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- Nominal -->
                            <div class="flex items-center">
                                <label class="w-1/4" for="nominal_jenispengeluaran">Nominal</label>
                                <input class="w-3/4 p-2 border rounded" id="nominal_jenispengeluaran"
                                    name="nominal_jenispengeluaran" type="text"
                                    value="{{ old('nominal_jenispengeluaran', $jenispengeluaran->nominal_jenispengeluaran) }}"
                                    required />
                            </div>
                            <div class="flex items-center">
                                <label class="w-1/4">Status</label>
                                <select class="w-3/4 p-2 border rounded" name="status" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="Aktif" {{ $jenispengeluaran->status == 'Aktif' ? 'selected' : '' }}>
                                        Aktif</option>
                                    <option value="Non Aktif" {{ $jenispengeluaran->status == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                                </select>
                            </div>
                            <div class="flex items-center">
                                <label class="w-1/4" for="idunitpendidikan">Unit</label>
                                <select class="w-3/4 p-2 border rounded" id="idunitpendidikan" name="idunitpendidikan">
                                    @foreach($unitpendidikan as $unit)
                                        <option value="{{ $unit->id }}" {{ $jenispengeluaran->idunitpendidikan == $unit->id ? 'selected' : '' }}>
                                            {{ $unit->namaUnit }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="flex justify-end mt-4">
                                <a href="{{ route('admin.jenis-pengeluaran') }}">
                                    <button class="bg-red-500 text-white px-4 py-2 rounded mr-2" type="button">
                                        Kembali
                                    </button>
                                </a>
                                <a href="{{ route('admin.jenis-pengeluaran') }}">
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