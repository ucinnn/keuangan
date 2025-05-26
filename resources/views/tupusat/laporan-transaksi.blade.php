<x-layout-tupusat>
    <x-slot name="header">
    </x-slot>

    <!-- Konten halaman -->
    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta content="width=device-width, initial-scale=1.0" name="viewport" />
            <title>Transaksi Kas Seluruh Unit Pendidikan</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        </head>

        <body class="bg-gray-100">
            <div class="flex h-screen">
                <!-- Main Content -->
                <div class="flex-1 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div class="text-2xl font-bold">Laporan Transaksi Seluruh Unit Pendidikan</div>
                    </div>

                    <div class="bg-white p-4 rounded shadow">
                        <div class="flex justify-between items-center mb-4">
                            <form method="GET" action="#" class="flex items-center space-x-4">
                                <!-- Dropdown Filter Unit Pendidikan -->
                                <select name="unitpendidikan" class="border border-gray-300 rounded p-2 text-sm" onchange="this.form.submit()">
                                    <option value="">Pilih Unit Pendidikan</option>
                                    <option value="2">Pemasukan</option>
                                    <option value="3">Pengeluaran</option>
                                </select>
                                <select name="unitpendidikan" class="border border-gray-300 rounded p-2 text-sm" onchange="this.form.submit()">
                                    <option value="">Pilih Jenis Transaksi</option>
                                    <option value="2">Pemasukan</option>
                                    <option value="3">Pengeluaran</option>
                                </select>
                            </form>
                        </div>

                        <div class="mb-4">
                        <span id="totalItems" class="text-sm font-medium text-gray-700">Total Data:</span>
                        </div>

                        <div id="noDataMessage" class="p-4 bg-yellow-200 text-yellow-800 rounded-lg mb-4 hidden">
                            <p>Maaf, saat ini tidak ada data Jenis Pemasukan yang sesuai dengan pencarian.</p>
                        </div>

                        <hr class="border-gray-300 mb-4" />

                        <!-- Table for Data -->
                        <div class="overflow-x-auto">
                            <table id="data-table" class="min-w-full bg-white border border-gray-300">
                                <thead>
                                    <tr class="bg-green-500 text-white text-center">
                                        <th class="py-2 px-4 border-r border-gray-300 w-16">No.</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Tanggal Transaksi</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Jenis Transaksi</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Nominal</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td class="py-2 px-4 border-r border-gray-300"> 1 </td>
                                        <td class="py-2 px-4 border-r border-gray-300"> 20 Januari 2023 </td>
                                        <td class="py-2 px-4 border-r border-gray-300"> Pemasukan </td>
                                        <td class="py-2 px-4 border-r border-gray-300" > Rp. 100.000 </td>
                                        <td class="py-2 px-4 border-r border-gray-300"> TK </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-4">
</div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>
</x-layout-tupusat>
