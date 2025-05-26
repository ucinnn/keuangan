<x-layout-tupusat>
    <x-slot name="header"></x-slot>

    <div class="container">
        <h1>Edit Transaksi Kas</h1>

        <form action="{{ route('tupusat.kas.update', $transaksiKas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="kas_id">Kas</label>
                <select name="kas_id" class="form-control" required>
                    @foreach ($kas as $item)
                        <option value="{{ $item->id }}" {{ $transaksiKas->kas_id == $item->id ? 'selected' : '' }}>
                            {{ $item->namaKas }} ({{ $item->kategori }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nominal">Nominal</label>
                <input type="number" name="nominal" class="form-control" value="{{ $transaksiKas->nominal }}" required>
            </div>

            <div class="form-group">
                <label for="unitpendidikan_id">Unit Pendidikan</label>
                <select name="unitpendidikan_id" class="form-control" required>
                    @foreach ($unitPendidikan as $unit)
                        <option value="{{ $unit->id }}" {{ $transaksiKas->unitpendidikan_id == $unit->id ? 'selected' : '' }}>
                            {{ $unit->namaUnit }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" class="form-control">{{ $transaksiKas->keterangan }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</x-layout-tupusat>
