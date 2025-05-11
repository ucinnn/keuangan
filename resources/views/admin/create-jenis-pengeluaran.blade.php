<x-layout-admin>
    <x-slot name="header">

    </x-slot>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <title>Manajemen Data Jenis pengeluaran</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    </head>

    <body class="bg-gray-100">
        <div class="flex flex-col h-screen">
            <!-- Main Content -->
            <div class="flex-1 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Manajemen Data Jenis pengeluaran</h2>
                    <div class="flex items-center">
                        <p class="mr-4"></p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded shadow-md">
                    <h2 class="text-xl font-bold mb-4 bg-green-500 text-white p-2 rounded">Tambah Data Jenis pengeluaran
                    </h2>

                    <!-- Menampilkan Notifikasi Error -->
                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-4 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.create-jenis-pengeluaran-submit') }}">


                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            <div class="flex items-center">
                                <label class="w-1/4" for="nama_pengeluaran">Nama pengeluaran</label>
                                <input class="w-3/4 p-2 border rounded" id="nama_pengeluaran" name="nama_pengeluaran"
                                    type="text" value="{{ old('nama_pengeluaran') }}" />
                            </div>
                            <div class="flex items-center">
                                <label class="w-1/4" for="tipe_pengeluaran">Tipe pengeluaran</label>
                                <select class="w-3/4 p-2 border rounded" id="type" name="type">
                                    <option>Pilih Tipe pengeluaran</option>
                                    <option value="Bulanan" {{ old('type') == 'Bulanan' ? 'selected' : '' }}>Bulanan
                                    </option>
                                    <option value="Semester" {{ old('type') == 'Semester' ? 'selected' : '' }}>Semester
                                    </option>
                                    <option value="Bebas" {{ old('type') == 'Bebas' ? 'selected' : '' }}>Bebas</option>
                                </select>
                            </div>
                            <div class="flex items-center">
                                <label class="w-1/4" for="tahun">Tahun Ajaran</label>
                                <select class="w-3/4 p-2 border rounded" id="tahun" name="id_tahunajaran">
                                    <option>Pilih Tahun Ajaran</option>
                                    @foreach ($tahunAjaran as $tahun)
                                        <option value="{{ $tahun->id }}" {{ old('id_tahunajaran') == $tahun->id ? 'selected' : '' }}>
                                            {{ $tahun->tahun_ajaran }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center">
                                <label class="w-1/4" for="nominal">Nominal</label>
                                <input class="w-3/4 p-2 border rounded" id="nominal_jenispengeluaran"
                                    name="nominal_jenispengeluaran" type="text"
                                    value="{{ old('nominal_jenispengeluaran') }}" />
                            </div>
                            <div class="flex items-center">
                                <label class="w-1/4">Status</label>
                                <select class="w-3/4 p-2 border rounded bg-gray-100" name="status_display" disabled>
                                    <option value="Aktif" selected>Aktif</option>
                                </select>
                                <!-- Input hidden untuk mengirimkan nilai ke server -->
                                <input type="hidden" name="status" value="Aktif">
                            </div>
                            <div class="flex items-center">
                                <label class="w-1/4" for="unit">Unit</label>
                                <select class="w-3/4 p-2 border rounded" id="idunitpendidikan" name="idunitpendidikan">
                                    <option>Pilih Unit</option>
                                    <option value="2" {{ old('idunitpendidikan') == '2' ? 'selected' : '' }}>TK</option>
                                    <option value="3" {{ old('idunitpendidikan') == '3' ? 'selected' : '' }}>SD</option>
                                    <option value="4" {{ old('idunitpendidikan') == '4' ? 'selected' : '' }}>SMP</option>
                                    <option value="5" {{ old('idunitpendidikan') == '5' ? 'selected' : '' }}>SMA</option>
                                    <option value="6" {{ old('idunitpendidikan') == '6' ? 'selected' : '' }}>MADIN
                                    </option>
                                    <option value="7" {{ old('idunitpendidikan') == '7' ? 'selected' : '' }}>TPQ
                                    </option>
                                    <option value="8" {{ old('idunitpendidikan') == '8' ? 'selected' : '' }}>Ya Pondok</option>
                                    <option value="9" {{ old('idunitpendidikan') == '9' ? 'selected' : '' }}>Tidak Pondok</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <a href="{{ route('admin.jenis-pengeluaran') }}">
                                <button class="bg-red-500 text-white px-4 py-2 rounded mr-2"
                                    type="button">Kembali</button>
                            </a>
                            <button class="bg-green-500 text-white px-4 py-2 rounded" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>
</x-layout-admin>