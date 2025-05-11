<x-layout-admin>
    <x-slot name="header">

    </x-slot>

    <html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Manajemen Data Siswa
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-gray-100">
  <div class="flex h-screen">
   <!-- Main Content -->
    <main class="flex-1 p-6">
     <div class="bg-white p-6 rounded shadow-md">
      <h2 class="text-xl font-semibold mb-4">
       Tambah Data Siswa
      </h2>
      <form action="{{ route('admin.submitUnitPendidikan') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 gap-4">
        <div class="flex items-center">
         <label class="w-1/3">Kategori</label>
         <select class="w-2/3 p-2 border rounded" name="kategori" class="form-control">
         <option value="" disabled selected>Pilih</option>
         <option value="-">-</option>
         <option value="formal">formal</option>
         <option value="Informal">Informal</option>
         <option value="Pondok">Pondok</option>
         </select>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Nama Unit Pendidikan</label>
         <select class="w-2/3 p-2 border rounded" name="namaUnit" class="form-control">
         <option value="" disabled selected>Pilih</option>
         <option value="-">-</option>
         <option value="TK">TK</option>
         <option value="SD">SD</option>
         <option value="SMP">SMP</option>
         <option value="SMA">SMA</option>
         <option value="MADIN">MADIN</option>
         <option value="TPQ">TPQ</option>
         <option value="YA PONDOK">YA PONDOK</option>
         <option value="TIDAK PONDOK">TIDAK PONDOK</option>
         </select>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Status</label>
         <select class="w-2/3 p-2 border rounded" name="status" class="form-control">
         <option value="Aktif">Aktif</option>
         <option value="Tidak Aktif">Tidak Aktif</option>
         </select>
        </div>
    </div>

       <div class="flex justify-end mt-4">
        <a href="{{ route('admin.manage-unit-pendidikan') }}">
        <button class="bg-red-500 text-white px-4 py-2 rounded mr-2" type="button">Kembali</button>
        </a>

        <a href="{{ route('admin.manage-unit-pendidikan') }}">
        <button class="bg-green-500 text-white px-4 py-2 rounded" type="submit">Simpan</button>
        </a>
       </div>

      </form>
     </div>
    </main>
   </div>
  </div>
 </body>
</html>
</x-layout-admin>
