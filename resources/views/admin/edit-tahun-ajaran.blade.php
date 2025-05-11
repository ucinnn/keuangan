<x-layout-admin>
   <x-slot name="header">

   </x-slot>
   
   <html lang="en">
<head>
   <meta charset="utf-8"/>
   <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
   <title>
      Edit Tahun Ajaran
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
            Edit Tahun Ajaran
         </h2>
         <form action="{{ route('admin.updateTahunAjaran', $tahunajaran->id) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-4">
               <div class="flex items-center">
                  <label class="w-1/3">Tahun Ajaran</label>
                  <input class="w-2/3 p-2 border rounded" type="year" name="tahun_ajaran" value="{{ $tahunajaran->tahun_ajaran }}" class="form-control"/>
               </div>

               <div class="flex items-center">
                  <label class="w-1/3">Awal</label>
                  <input class="w-2/3 p-2 border rounded" type="date" name="awal" value="{{ $tahunajaran->awal }}" class="form-control"/>
               </div>

               <div class="flex items-center">
                  <label class="w-1/3">Akhir</label>
                  <input class="w-2/3 p-2 border rounded" type="date" name="akhir" value="{{ $tahunajaran->akhir }}" class="form-control"/>
               </div>

               <div class="flex items-center">
                  <label class="w-1/3">Status</label>
                  <select class="w-2/3 p-2 border rounded" name="status" class="form-control">
                  <option value="Aktif" {{ $tahunajaran->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                  <option value="Non Aktif" {{ $tahunajaran->status == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                  </select>
               </div>
            </div>

            <div class="flex justify-end mt-4">
               <a href="{{ route('admin.manage-tahun-ajaran') }}">
                  <button class="bg-red-500 text-white px-4 py-2 rounded mr-2" type="button">Kembali</button>
               </a>
               
               <a href="{{ route('admin.manage-tahun-ajaran') }}">
                  <button class="bg-green-500 text-white px-4 py-2 rounded" type="submit">Perbarui</button>
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