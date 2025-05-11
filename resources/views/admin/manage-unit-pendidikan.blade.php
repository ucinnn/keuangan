<x-layout-admin>
    <x-slot name="header">

    </x-slot>

    <html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Manajemen Data Unit Pendidikan
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-gray-100">
  <div class="flex h-screen">
   <!-- Main Content -->
   <div class="flex-1 p-6">
    <div class="flex justify-between items-center mb-6">
     <div class="text-2xl font-bold">
      Manajemen Data Siswa
     </div>
    </div>
    <div class="bg-white p-4 rounded shadow">
     <div class="flex justify-between items-center mb-4">
      <div class="flex items-center space-x-4">
      <form method="GET" action="{{ route('admin.manage-unit-pendidikan') }}" class="flex gap-4 mb-4">
    <!-- Filter Kategori -->
    <select name="kategori" class="border border-gray-300 rounded p-2">
        <option value="">Pilih Kategori</option>
        @foreach ($kategoriList as $kategori)
            <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                {{ $kategori }}
            </option>
        @endforeach
    </select>

    <!-- Filter Nama Unit Pendidikan -->
    <select name="namaUnit" class="border border-gray-300 rounded p-2">
        <option value="">Pilih Nama Unit Pendidikan</option>
        @foreach ($namaUnitList as $unit)
            <option value="{{ $unit }}" {{ request('namaUnit') == $unit ? 'selected' : '' }}>
                {{ $unit }}
            </option>
        @endforeach
    </select>

    <select name="status" class="border border-gray-300 rounded p-2">
        <option value="">Pilih Status</option>
        <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
        <option value="Tidak Aktif" {{ request('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
    </select>

    <!-- Submit Button -->
    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">
        Filter
    </button>
</form>
      </div>
      <div class="flex items-center space-x-4">
       <a href="{{ route('admin.create-manage-unit-pendidikan') }}">
                    <x-primary-button class="bg-green-500 text-white px-4 py-2 rounded flex items-center">
                    <i class="fas fa-plus mr-2">
                    </i>
                        {{ __('Tambah Data') }}
                    </x-primary-button>
        </a>
      </div>
     </div>
     <div class="flex justify-between items-center mb-4">
      <div class="flex items-center space-x-2">
       <label class="text-sm" for="entries">Show</label>
       <select class="border border-gray-300 rounded p-2" id="entries">
        <option>10</option>
        <option>20</option>
        <option>30</option>
        <option>40</option>
        <option>50</option>
       </select>
       <label class="text-sm" for="entries">entries</label>
      </div>

     </div>
     <div class="overflow-x-auto">
     <table class="min-w-full bg-white border border-gray-300">
        <tr class="bg-green-500 text-white text-center">
         <th class="py-2 px-4 border-r border-gray-300">No.</th>
         <th class="py-2 px-4 border-r border-gray-300">Kategori</th>
         <th class="py-2 px-4 border-r border-gray-300">Nama Unit </th>
         <th class="py-2 px-4 border-r border-gray-300">Status</th>
         <th class="py-2 px-4 border-r border-gray-300">Aksi</th>
        </tr>
        @foreach ($unitpendidikan as $no=>$data)
        <tr class="bg-white text-black text-center border-b border-gray-300">
         <td class="py-2 px-4 border-r border-gray-300">{{ $no+1 }}</td>
         <td class="py-2 px-4 border-r border-gray-300">{{ $data->kategori }}</td>
         <td class="py-2 px-4 border-r border-gray-300">{{ $data->namaUnit }}</td>
         <td class="py-2 px-4 border-r border-gray-300">{{ $data->status }}</td>
         <td class="flex justify-center space-x-2 py-2">
            <a href="{{ route('admin.edit-manage-unit-pendidikan', $data->id) }}">
                <button class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</button>
            </form>
         </td>
        </tr>
        @endforeach
    </table>
     </div>
    </div>
   </div>
  </div>
 </body>
</html>
</x-layout-admin>
