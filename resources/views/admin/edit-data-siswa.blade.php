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
       Ubah Data Siswa
      </h2>
      <form action="{{ route('admin.updateSiswa', $siswas->id) }}" method="POST">
        @csrf
       <div class="grid grid-cols-1 gap-4">
        <div class="flex items-center">
         <label class="w-1/3">NIS</label>
         <input class="w-2/3 p-2 border rounded" type="text" name="nis" value="{{ $siswas->nis }}" class="form-control"/>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">NISN</label>
         <input class="w-2/3 p-2 border rounded" type="text" name="nisn" value="{{ $siswas->nisn }}" class="form-control"/>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Nama Siswa</label>
         <input class="w-2/3 p-2 border rounded" type="text" name="nama" value="{{ $siswas->nama }}" class="form-control"/>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Jenis Kelamin</label>
         <select class="w-2/3 p-2 border rounded" name="jenis_kelamin" class="form-control">
              <option value="">Pilih</option>
              <option value="Laki-laki" {{ $siswas->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ $siswas->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Kelas</label>
         <select class="w-2/3 p-2 border rounded" name="kelas_id" id="kelas_id" class="form-control" required>
          <option value="" disabled selected>Pilih</option>
          <option value="{{ $siswas->kelas_id }}" selected>{{ $siswas->kelas->nama_kelas }}</option>
          @foreach($kelas as $data)
          <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
          @endforeach
         </select>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Agama</label>
         <select class="w-2/3 p-2 border rounded" name="agama" class="form-control">
              <option value="">Pilih</option>
              <option value="Islam" {{ $siswas->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
              <option value="Kristen" {{ $siswas->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
              <option value="Katolik" {{ $siswas->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
              <option value="Hindu" {{ $siswas->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
              <option value="Budha" {{ $siswas->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
              <option value="Konghucu" {{ $siswas->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
          </select>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Nama Orang Tua / Wali</label>
         <input class="w-2/3 p-2 border rounded" type="text" name="namaOrtu" value="{{ $siswas->namaOrtu }}" class="form-control"/>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Alamat Orang Tua</label>
         <input class="w-2/3 p-2 border rounded" type="text" name="alamatOrtu" value="{{ $siswas->alamatOrtu }}" class="form-control"/>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">No Telp. / WA Ortu</label>
         <input class="w-2/3 p-2 border rounded" type="text" name="noTelp" value="{{ $siswas->noTelp }}" class="form-control"/>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Email</label>
         <input class="w-2/3 p-2 border rounded" type="email" name="email" value="{{ $siswas->email }}" class="form-control"/>
        </div>

        <div class="flex items-center">
            <label class="w-1/3">Unit Pendidikan Formal</label>
            <select class="w-2/3 p-2 border rounded" name="unitpendidikan_id" id="unitpendidikan_id" class="form-control" required>
                <option value="" disabled>Pilih</option>
                @foreach($unitpendidikan as $data)
                    @if(in_array($data->id, [2, 3, 4, 5]))
                        <option value="{{ $data->id }}" 
                            {{ old('unitpendidikan_id', $siswas->unitpendidikan_id) == $data->id ? 'selected' : '' }}>
                            {{ $data->namaUnit }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="flex items-center">
            <label class="w-1/3">Unit Pendidikan Informal</label>
            <select class="w-2/3 p-2 border rounded" name="unitpendidikan_idInformal" id="unitpendidikan_idInformal" class="form-control" required>
                <option value="" disabled>Pilih</option>
                @foreach($unitpendidikan as $data)
                    @if(in_array($data->id, [6, 7]))
                        <option value="{{ $data->id }}" 
                            {{ old('unitpendidikan_id', $siswas->unitpendidikan_id) == $data->id ? 'selected' : '' }}>
                            {{ $data->namaUnit }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="flex items-center">
            <label class="w-1/3">Status Pondok</label>
            <select class="w-2/3 p-2 border rounded" name="unitpendidikan_idPondok" id="unitpendidikan_idPondok" class="form-control" required>
                <option value="" disabled>Pilih</option>
                @foreach($unitpendidikan as $data)
                    @if(in_array($data->id, [8, 9]))
                        <option value="{{ $data->id }}" 
                            {{ old('unitpendidikan_id', $siswas->unitpendidikan_id) == $data->id ? 'selected' : '' }}>
                            {{ $data->namaUnit }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- <div class="flex items-center">
         <label class="w-1/3">Unit Pendidikan Informal</label>
         <select class="w-2/3 p-2 border rounded" name="unitPendidikanInformal" class="form-control">
              <option value="">Pilih</option>
              <option value="Madin" {{ $siswas->unitPendidikanInformal == 'Madin' ? 'selected' : '' }}>Madin</option>
              <option value="TPQ" {{ $siswas->unitPendidikanInformal == 'TPQ' ? 'selected' : '' }}>TPQ</option>
              <option value="tidak" {{ $siswas->unitPendidikanInformal == 'tidak' ? 'selected' : '' }}>Tidak Semua</option>
          </select>
        </div>

        <div class="flex items-center">
         <label class="w-1/3">Status Pondok</label>
         <select class="w-2/3 p-2 border rounded" name="statusPondok" class="form-control">
              <option value="">Pilih</option>
              <option value="Ya" {{ $siswas->statusPondok == 'Ya' ? 'selected' : '' }}>Ya</option>
              <option value="Tidak" {{ $siswas->statusPondok == 'Tidak' ? 'selected' : '' }}>Tidak</option>
          </select>
        </div> -->

        <div class="flex items-center">
         <label class="w-1/3">Status</label>
         <select class="w-2/3 p-2 border rounded" name="status" class="form-control">
              <option value="">Pilih</option>
              <option value="Aktif" {{ $siswas->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
              <option value="Non Aktif" {{ $siswas->status == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
              <option value="Drop Out" {{ $siswas->status == 'Drop Out' ? 'selected' : '' }}>Drop Out</option>
              <option value="Pindah" {{ $siswas->status == 'Pindah' ? 'selected' : '' }}>Pindah</option>
              <option value="Lulus" {{ $siswas->status == 'Lulus' ? 'selected' : '' }}>Lulus</option>
          </select>
        </div>
       </div>

       <div class="flex justify-end mt-4">
        <a href="{{ route('admin.manage-data-siswa') }}">
        <button class="bg-red-500 text-white px-4 py-2 rounded mr-2" type="button">Kembali</button>
        </a>
        
        <a href="{{ route('admin.manage-data-siswa') }}">
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