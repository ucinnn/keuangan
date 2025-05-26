<x-layout-tupusat>
    <x-slot name="header"></x-slot>

<div class="container">
    <h1>Tambah Transaksi Kas</h1>

    <form action="{{ route('tupusat.kas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="kas_id">Kas</label>
            <select name="kas_id" id="kas_id" class="form-control" required>
                <option value="">Pilih Kas</option>
                @foreach ($kas as $item)
                <option value="{{ $item->id }}">{{ $item->namaKas }} ({{ $item->kategori }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="nominal">Nominal</label>
            <input type="number" name="nominal" id="nominal" class="form-control" step="0.01" min="0" required>
        </div>

        <div class="form-group">
            <label for="unitpendidikan_id">Unit Pendidikan</label>
            <select name="unitpendidikan_id" id="unitpendidikan_id" class="form-control" required>
                <option value="">Pilih Unit Pendidikan</option>
                @foreach ($unitpendidikan as $unit)
                <option value="{{ $unit->id }}">{{ $unit->namaUnit }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>
</div>

</x-layout-tupusat>