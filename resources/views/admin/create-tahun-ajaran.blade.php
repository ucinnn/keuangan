<x-layout-admin>
    <x-slot name="header">

    </x-slot>
    
    <html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>
    Manajemen Tahun Ajaran
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
          Tambah Tahun Ajaran
        </h2>
        <form action="{{ route('admin.submitTahunAjaran') }}" method="POST">
          @csrf
        <div class="grid grid-cols-1 gap-4">
          <div class="flex items-center">
            <label class="w-1/3">Tahun Ajaran</label>
            <input class="w-2/3 p-2 border rounded" type="year" name="tahun_ajaran" class="form-control"/>
          </div>

          <div class="flex items-center">
            <label class="w-1/3">Awal</label>
            <input class="w-2/3 p-2 border rounded" type="date" name="awal" class="form-control"/>
          </div>
          
          <div class="flex items-center">
            <label class="w-1/3">Akhir</label>
            <input class="w-2/3 p-2 border rounded" type="date" name="akhir" class="form-control"/>
          </div>

          <div class="flex items-center">
            <label class="w-1/3">Status</label>
            <select class="w-2/3 p-2 border rounded bg-gray-100" name="status_display" disabled>
              <option value="Aktif" selected>Aktif</option>
            </select>
            <!-- Input hidden untuk mengirimkan nilai ke server -->
            <input type="hidden" name="status" value="Aktif">
          </div>
        </div>

        <div class="flex justify-end mt-4">
          <a href="{{ route('admin.manage-tahun-ajaran') }}">
          <button class="bg-red-500 text-white px-4 py-2 rounded mr-2" type="button">Kembali</button>
          </a>
          
          <a href="{{ route('admin.manage-tahun-ajaran') }}">
          <button class="bg-green-500 text-white px-4 py-2 rounded" type="submit">Simpan</button>
          </a>
        </div>
        </form>
      </div>
      </main>
    </div>
    </div>
    <script>
        function updateEndDate() {
            let awalInput = document.querySelector("input[name='awal']");
            let akhirInput = document.querySelector("input[name='akhir']");

            awalInput.addEventListener("change", function () {
                if (awalInput.value) {
                    let awalDate = new Date(awalInput.value);
                    awalDate.setMonth(awalDate.getMonth() + 6); // Tambah 6 bulan
                    
                    // Format YYYY-MM-DD untuk input date
                    let akhirDate = awalDate.toISOString().split("T")[0];

                    // Set nilai pada input akhir
                    akhirInput.value = akhirDate;
                }
            });
        }

        window.onload = updateEndDate;
    </script>
   </body>
</html>
</x-layout-admin>