<x-layout-admin>
    <x-slot name="header"> </x-slot>

    <html lang="en">
        <head>
            <meta charset="utf-8" />
            <meta content="width=device-width, initial-scale=1.0" name="viewport" />
            <title>Manajemen Data User</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        </head>
        <body class="bg-gray-100">


            <div class="flex h-screen">
                <div class="flex-1 p-6">

                    <div class="flex justify-between items-center mb-6">
                        <div class="text-2xl font-bold">Manage User</div>
                    </div>

                    <div class="bg-white p-4 rounded shadow">


                        <!-- Filter and Add User Section -->
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center space-x-4">
                                <select id="role" name="role" class="border border-gray-300 rounded p-2">
                                    <option value="all">Pilih Peran</option>
                                    <option value="admin">Admin</option>
                                    <option value="tupusat">Tu Pusat</option>
                                    <option value="tuunit">Tu Unit</option>
                                </select>
                            </div>

                            <div class="flex items-center space-x-4">
                                <form action="{{ route('admin.create-user') }} ">
                                    <x-primary-button type="submit" class="bg-green-500 text-white px-4 py-2 rounded flex items-center">
                                    <i class="fas fa-plus mr-2"></i>
                                    {{ ('Tambah Data') }}
                                    </x-primary-button>
                                </form>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center space-x-2">
                                <label for="show" class="text-sm">Show:</label>
                                <select id="show" name="show" class="border border-gray-300 rounded p-2">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <label for="entries" class="text-sm">Entries</label>
                            </div>

                            <form method="GET" action="{{ route('admin.manage-user') }}" class="flex items-center space-x-2 w-full max-w-lg">
                                <label class="text-sm" for="search">Cari :</label>
                                <input
                                    class="border border-gray-300 rounded p-2 flex-grow"
                                    id="search"
                                    name="search"
                                    type="text"
                                    placeholder="Cari Nama atau Username"
                                    value="{{ request('search') }}"
                                    oninput="handleSearchInput()"
                                />
                                <button class="bg-blue-500 text-white px-4 py-2 rounded">Cari</button>
                            </form>
                        </div>

                        <div class="mb-4">
                            <span id="totalItems" class="text-sm font-medium text-gray-700">Total Data: {{ $users->count() }}</span>
                        </div>


                        @if ($users->isEmpty())
                        <div class="p-4 bg-yellow-200 text-yellow-800 rounded-lg mb-4">
                            <p>Maaf, saat ini tidak ada data pengguna yang tersedia.</p>
                        </div>
                        @endif

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300">
                                <thead class="bg-green-500 text-white text-center">
                                    <tr>
                                        <th class="py-2 px-4 border-r border-gray-300">No.</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Nama</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Email</th>
                                        <th class="py-2 px-4 border-r border-gray-300">No. Telp</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Username</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Password</th>
                                        <th class="py-2 px-4 border-r border-gray-300">Peran</th> <!-- Lebar lebih kecil -->
                                        <th class="py-2 px-4 border-r border-gray-300">Unit</th> <!-- Lebar lebih kecil -->
                                        <th colspan="2" class="py-2 px-4 border-r border-gray-300">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="userTable">
                                    @foreach ($users as $item)
                                    <tr class="bg-white text-black text-center border-b border-gray-300" data-role="{{ strtolower($item->role) }}">
                                        <td class="py-2 px-4 border-r border-gray-300 ">{{ $loop->iteration }}</td>
                                        <td class="py-2 px-4 border-r border-gray-300">{{ $item->name }}</td>
                                        <td class="py-2 px-4 border-r border-gray-300">{{ $item->email }}</td>
                                        <td class="py-2 px-4 border-r border-gray-300">{{ $item->no_telp }}</td>
                                        <td class="py-2 px-4 border-r border-gray-300">{{ $item->username }}</td>

                                        <td class="py-2 px-4 border-r border-gray-300">
                                            <div class="flex items-center space-x-2">
                                                <!-- Input Password -->
                                                <input type="password"
                                                    id="password-{{ $item->id }}"
                                                    value="{{ $item->password }}"
                                                    class="password-input w-full px-2 py-1 border border-gray-300 rounded bg-gray-50 text-gray-700 truncate center"
                                                    readonly>

                                                <!-- Tombol Toggle Password -->
                                                <button type="button"
                                                        onclick="togglePassword({{ $item->id }})"
                                                        class="p-1 focus:outline-none">
                                                    <i class="fas fa-eye text-black" id="eye-icon-{{ $item->id }}"></i>
                                                </button>
                                            </div>
                                        </td>


                                        <td class="border border-gray-300 px-1 py-0.5 text-xs truncate text-center">{{ $item->role }}</td>
                                        <td class="border border-gray-300 px-1 py-0.5 text-xs truncate text-center">{{ $item->namaUnit }}</td>
                                        <td class="border border-gray-300 px-1 py-0.5 text-xs text-center">
                                            <a href="{{ route('admin.update-user', $item->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-xs font-medium rounded hover:bg-yellow-900 transition duration-150 ease-in-out">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-1.036L6.75 17.75a2 2 0 11-2.829-2.829L13.5 4.5m1.061-1.061L17.5 7.5m-3.061-4.061a2 2 0 113.536 1.536L8.75 16.25a2 2 0 11-2.829-2.829L13.5 4.5m1.061-1.061z" />
                                                </svg>
                                                Edit
                                            </a>
                                        </td>
                                        <td class="border border-gray-300 px-1 py-0.5 text-xs text-center">
                                            <a href="{{ route('admin.deleteuserrr', $item->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-xs font-medium rounded hover:bg-red-600 transition duration-150 ease-in-out"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2v6m-6 4h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                                </svg>
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function handleSearchInput() {
                    const searchInput = document.getElementById('search');
                    if (searchInput.value.trim() === '') {
                        const url = new URL(window.location.href);
                        url.searchParams.delete('search');
                        window.location.href = url.toString();
                    }
                }
            </script>
        </body>
    </html>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const showDropdown = document.getElementById('show');
            const roleDropdown = document.getElementById('role');
            const tableRows = document.querySelectorAll('.user-row');
            const totalItemsElement = document.getElementById('totalItems');

            function updateTotalItems() {
                const visibleRows = Array.from(tableRows).filter(row => row.style.display !== 'none');
                totalItemsElement.textContent = Total Data: ${visibleRows.length};
            }

            searchInput.addEventListener('input', function () {
                const searchTerm = searchInput.value.toLowerCase();
                tableRows.forEach(row => {
                    const nameCell = row.querySelector('td:nth-child(2)');
                    const nameText = nameCell ? nameCell.textContent.toLowerCase() : '';
                    if (nameText.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
                updateTotalItems();
            });

            showDropdown.addEventListener('change', function () {
                const numberOfRows = parseInt(showDropdown.value, 10);
                tableRows.forEach((row, index) => {
                    if (index < numberOfRows) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
                updateTotalItems();
            });

            roleDropdown.addEventListener('change', function () {
                const selectedRole = roleDropdown.value.toLowerCase();
                tableRows.forEach(row => {
                    const roleCell = row.getAttribute('data-role');
                    if (selectedRole === 'all' || roleCell.includes(selectedRole)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
                updateTotalItems();
            });

            updateTotalItems();
        });

        function togglePassword(userId) {
            const passwordInput = document.getElementById(password-${userId});
            const eyeIcon = document.getElementById(eye-icon-${userId});

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
</x-layout-admin>
