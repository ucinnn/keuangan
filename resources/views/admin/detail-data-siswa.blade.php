<x-layout-admin>
    <x-slot name="header">

    </x-slot>

    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>
            Detail Data Siswa
        </title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    </head>
    <body class="bg-gray-100">
        <div class="flex h-screen">
            <!-- Main Content -->
            <main class="flex-1 p-6">
                <div class="bg-white p-6 rounded shadow-md">
                    <h2 class="text-xl font-semibold mb-4">
                        Detail Data Siswa
                    </h2>
                    <!-- Form Deskripsi -->
                    <div class="grid grid-cols-1 gap-4">
                        <div class="flex items-center">
                            <label class="w-1/3">NIS:</label>
                            <input type="text" value="{{ $siswas->nis }}" class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>

                        <div class="flex items-center">
                            <label class="w-1/3">NISN:</label>
                            <input type="text" value="{{ $siswas->nisn }}" class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>

                        <div class="flex items-center">
                            <label class="w-1/3">Nama Siswa:</label>
                            <input type="text" value="{{ $siswas->nama }}" class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>

                        <div class="flex items-center">
                            <label class="w-1/3">Jenis Kelamin:</label>
                            <input type="text" value="{{ $siswas->jenis_kelamin }}" class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>

                        <div class="flex items-center">
                            <label class="w-1/3">Kelas:</label>
                            <input type="text" value="{{ $siswas->kelas->nama_kelas }}" class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>

                        <div class="flex items-center">
                            <label class="w-1/3">Status:</label>
                            <input type="text" value="{{ $siswas->status }}" class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>

                        <div class="flex items-center">
                            <label class="w-1/3">Agama:</label>
                            <input type="text" value="{{ $siswas->agama }}" class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>

                        <div class="flex items-center">
                            <label class="w-1/3">Nama Orang Tua / Wali:</label>
                            <input type="text" value="{{ $siswas->namaOrtu }}" class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>

                        <div class="flex items-center">
                            <label class="w-1/3">Alamat Orang Tua:</label>
                            <input type="text" value="{{ $siswas->alamatOrtu }}" class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>

                        <div class="flex items-center">
                            <label class="w-1/3">No Telp. / WA Ortu:</label>
                            <input type="text" value="{{ $siswas->noTelp }}" class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>

                        <div class="flex items-center">
                            <label class="w-1/3">Email:</label>
                            <input type="email" value="{{ $siswas->email }}" class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>

                        <div class="flex items-center">
                            <label class="w-1/3">Unit Pendidikan Formal</label>
                            <input type="text" value="{{ optional($unitpendidikan->firstWhere('id', $siswas->unitpendidikan_id))->namaUnit }}" 
                                class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>

                        <div class="flex items-center">
                            <label class="w-1/3">Unit Pendidikan Informal</label>
                            <input type="text" value="{{ optional($unitpendidikan->firstWhere('id', $siswas->unitpendidikan_idInformal))->namaUnit }}" 
                                class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>

                        <div class="flex items-center">
                            <label class="w-1/3">Status Pondok</label>
                            <input type="text" value="{{ optional($unitpendidikan->firstWhere('id', $siswas->unitpendidikan_idPondok))->namaUnit }}" 
                                class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>

                        <div class="flex items-center">
                            <label class="w-1/3">Status:</label>
                            <input type="text" value="{{ $siswas->status }}" class="w-2/3 p-2 border border-gray-300 rounded" readonly>
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <a href="{{ route('admin.manage-data-siswa') }}">
                            <button class="bg-red-500 text-white px-4 py-2 rounded" type="button">Kembali</button>
                        </a>
                    </div>

                </div>
            </main>
        </div>
    </body>
    </html>
</x-layout-admin>
