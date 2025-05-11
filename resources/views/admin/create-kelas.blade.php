<x-layout-admin>
    <x-slot name="header">
        <!-- You can add header content here if needed -->
    </x-slot>
    <html>
    <head>
        <title>Manajemen Data Kelas</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
        <div class="container mx-auto mt-10 max-w-4xl">
            <h1 class="text-2xl font-semibold mb-6">Manajemen Data Kelas</h1>
            <div class="bg-green-500 p-4 rounded-t-lg">
                <h2 class="text-white text-lg">Tambah Data Kelas</h2>
            </div>
            <div class="border border-green-500 p-6 rounded-b-lg bg-white">
            <form action="{{ route('admin.submitt') }}" method="POST" class="inline-block">
                @csrf
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="id_kelas">ID Kelas</label>
                            <input class="w-full px-3 py-2 border rounded bg-gray-200" id="id" name="id_kelas" type="text" placeholder="ID Kelas" disabled>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="unitpendidikan_id">Unit Pendidikan</label>
                            <select id="unitpendidikan_id" name="unitpendidikan_id" class="w-3/4 px-4 py-2 border rounded-md focus:ring focus:ring-green-300">
                                <option value="" disabled selected>Pilih</option>
                                @foreach($unitpendidikan as $itemm)
                                <option value="{{ $itemm->id }}">{{ $itemm->namaUnit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="nama_kelas">Kelas</label>
                            <input class="w-full px-3 py-2 border rounded" id="nama_kelas" name="nama_kelas" type="text" placeholder="Nama Kelas">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="grade">Grade</label>
                            <select id="grade" name="grade" class="w-3/4 px-4 py-2 border rounded-md focus:ring focus:ring-green-300">
                                <option value="">Pilih Grade</option>
                                <option value="-">-</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="keterangan">Keterangan</label>
                            <input class="w-full px-3 py-2 border rounded" id="keterangan" name="keterangan" type="text" placeholder="Keterangan">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2" for="status">Status</label>
                            <select class="w-full px-3 py-2 border rounded" id="status" name="status">
                                <option value="AKTIF">AKTIF</option>
                                <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                            </select>
                        </div>

                    </div>
                    <div class="flex justify-end space-x-4 mt-4">
                    <a href="{{ route('admin.manage-kelas') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
    Kembali </a>  
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
    </html>
</x-layout-admin>