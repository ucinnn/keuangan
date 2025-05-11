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
      <form action="{{ route('admin.submitSiswa') }}" method="POST">
        @csrf
       <div class="grid grid-cols-1 gap-4">
        <div class="flex items-center">
         <label class="w-1/3">NIS</label>
         <input class="w-2/3 p-2 border rounded" type="text" name="nis" class="form-control" required/>
        </div>
        
        <div class="flex items-center">
         <label class="w-1/3">NISN</label>
         <input class="w-2/3 p-2 border rounded" type="text" name="nisn" class="form-control"/>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Nama Siswa</label>
         <input class="w-2/3 p-2 border rounded" type="text" name="nama" class="form-control" required/>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Jenis Kelamin</label>
         <select class="w-2/3 p-2 border rounded" name="jenis_kelamin" class="form-control" required>
          <option value="" disabled selected>Pilih</option>
          <option value="Laki-laki">Laki-laki</option> 
          <option value="Perempuan">Perempuan</option>
         </select>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Kelas</label>
         <select class="w-2/3 p-2 border rounded" name="kelas_id" id="kelas_id" class="form-control" required>
          <option value="" disabled selected>Pilih</option>
          @foreach($kelas as $data)
          <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
          @endforeach
         </select>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Agama</label>
         <select class="w-2/3 p-2 border rounded" name="agama" class="form-control" required>
         <option value="" disabled selected>Pilih</option>
         <option value="Islam">Islam</option>
         <option value="Kristen">Kristen</option>
         <option value="Katolik">Katolik</option>
         <option value="Hindu">Hindu</option>
         <option value="Budha">Budha</option>
         <option value="Konghucu">Konghucu</option>
         </select>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Nama Orang Tua / Wali</label>
         <input class="w-2/3 p-2 border rounded" type="text" name="namaOrtu" class="form-control" required/>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Alamat Orang Tua</label>
         <input class="w-2/3 p-2 border rounded" type="text" name="alamatOrtu" class="form-control" required/>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">No Telp. / WA Ortu</label>
         <input class="w-2/3 p-2 border rounded" type="text" name="noTelp" class="form-control"/>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Email</label>
         <input class="w-2/3 p-2 border rounded" type="email" name="email" class="form-control"/>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Unit Pendidikan Formal</label>
         <select class="w-2/3 p-2 border rounded" name="unitpendidikan_id" id="unitpendidikan_id" class="form-control" required>
          <option value="" disabled selected>Pilih</option>
          @foreach($unitpendidikan as $data)
            @if(in_array($data->id, [2, 3, 4, 5]))
              <option value="{{ $data->id }}">{{ $data->namaUnit }}</option>
            @endif
          @endforeach
         </select>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Unit Pendidikan Informal</label>
         <select class="w-2/3 p-2 border rounded" name="unitpendidikan_idInformal" id="unitpendidikan_idInformal" class="form-control" required>
          <option value="" disabled selected>Pilih</option>
          @foreach($unitpendidikan as $data)
            @if(in_array($data->id, [6, 7]))
              <option value="{{ $data->id }}">{{ $data->namaUnit }}</option>
            @endif
          @endforeach
         </select>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Status Pondok</label>
         <select class="w-2/3 p-2 border rounded" name="unitpendidikan_idPondok" id="unitpendidikan_idPondok" class="form-control" required>
          <option value="" disabled selected>Pilih</option>
          @foreach($unitpendidikan as $data)
            @if(in_array($data->id, [8, 9]))
              <option value="{{ $data->id }}">{{ $data->namaUnit }}</option>
            @endif
          @endforeach
         </select>
        </div>

        <!-- <div class="flex items-center">
         <label class="w-1/3">Unit Pendidikan Informal</label>
         <select class="w-2/3 p-2 border rounded" name="unitPendidikanInformal" class="form-control" required>
         <option value="" disabled selected>Pilih</option>
         <option value="Madin">Madin</option>
         <option value="TPQ">TPQ</option>
         <option value="tidak">Tidak Semua</option>
         </select>
        </div> -->

        <!-- <div class="flex items-center">
         <label class="w-1/3">Status Pondok</label>
         <select class="w-2/3 p-2 border rounded" name="statusPondok" class="form-control" required>
         <option value="" disabled selected>Pilih</option>
         <option value="Ya">Ya</option>
         <option value="Tidak">Tidak</option>
         </select>
        </div> -->

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
        <a href="{{ route('admin.manage-data-siswa') }}">
        <button class="bg-red-500 text-white px-4 py-2 rounded mr-2" type="button">Kembali</button>
        </a>
        
        <a href="{{ route('admin.manage-data-siswa') }}">
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