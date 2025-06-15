<!DOCTYPE html>
<html>
<head>
    <title>Kwitansi Pembayaran</title>
    <style>
        body { font-family: 'Arial', sans-serif; font-size: 12px; margin: 0; padding: 0px; }
        .wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .kwitansi {
            width: 48%;
            border: 1px solid #000;
            padding: 20px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .logo {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }
        .judul {
            font-weight: bold;
            font-size: 14px;
            text-align: left;
        }
        .info {
            margin: 5px 0;
        }
        .footer {
            margin-top: 10px;
            text-align: right;
            font-style: italic;
        }
        .ttd {
            margin-top: 25px;
            text-align: right;
        }
        .ttd p {
            margin: 0;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        @foreach($tagihans as $index => $tagihan)
            <div class="kwitansi">
                <div class="header">
                    <img src="{{ public_path('logo-yysn.png') }}" class="logo" alt="Logo">
                    <div class="judul">
                        KWITANSI PEMBAYARAN<br>
                        <small>Yayasan Nurul Huda</small>
                    </div>
                </div>

                <div class="info"><strong>No. Kwitansi:</strong> KW-{{ str_pad($tagihan->id, 5, '0', STR_PAD_LEFT) }}</div>
                <div class="info"><strong>Nama:</strong> {{ $tagihan->siswa->nama }}</div>
                <div class="info"><strong>NIS:</strong> {{ $tagihan->siswa->nis }}</div>
                <div class="info"><strong>Pembayaran:</strong> {{ $tagihan->jenisPembayaran->nama_pembayaran }} ({{ $tagihan->jenisPembayaran->type }})</div>
                <div class="info"><strong>Tahun Ajaran:</strong> {{ $tagihan->tahunAjaran->tahun_ajaran }}</div>
                @if($tagihan->bulan)
                    <div class="info"><strong>Bulan/Semester:</strong> {{ $tagihan->bulan }}</div>
                @endif
                <div class="info"><strong>Tanggal Bayar:</strong> {{ \Carbon\Carbon::parse($tagihan->tanggal_bayar)->translatedFormat('d F Y') }}</div>
                <div class="info"><strong>Jumlah:</strong> Rp {{ number_format($tagihan->jumlah_dibayar, 0, ',', '.') }}</div>
                <div class="info"><strong>Jumlah Dibayar:</strong> Rp {{ number_format($tagihan->jumlah_dibayar, 0, ',', '.') }}</div>
                <div class="info"><strong>Status:</strong> {{ $tagihan->status }}</div>

                <div class="ttd">
                    <p>Petugas</p>
                    <br><br>
                    <p>______________________</p>
                </div>

                <div class="footer">
                    Dicetak: {{ now()->format('d-m-Y H:i') }}
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
