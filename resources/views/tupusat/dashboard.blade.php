<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<x-layout-tupusat>
    <x-slot name="header">

    </x-slot>
    <div class="bg-gray-100">
        <div class="flex p-8 gap-4 mb-6 flex-row items-stretch">
            <div class="flex flex-col w-full h-85 justify-between">
                <div class="flex-1 p-4">
                    <p class="text-lg font-semibold mb-4">Total Siswa</p>
                    <canvas id="impressionChart"></canvas>
                </div>>
            </div>
        </div>
        <div class="flex p-8 gap-4 mb-6 flex-row items-stretch">
            <div class="flex flex-col w-1/2 h-full justify-between">
                <div class="flex-1 p-4">
                </div>
                <div class="flex-1 p-4 m-2 m bg-white rounded-lg shadow-md text-center min-w-[200px]">
                    <p class="text-sm text-gray-500">Jumlah Total User</p>
                    <p class="text-2xl font-semibold">useer</p>
                    <p class="text-green-500 text-sm mt-1">+33.45%</p>
                </div>
            </div>
            <div class="flex flex-col w-1/2 h-full justify-between ">
                <div class="flex-1 p-4">
                </div>
                <div class="flex-1 p-4 m-2 m bg-white rounded-lg shadow-md text-center min-w-[200px]">
                    <p class="text-sm text-gray-500">Jumlah Total Siswa</p>
                    <p class="text-2xl font-semibold">$11.675 M</p>
                    <p class="text-green-500 text-sm mt-1">+33.45%</p>
                </div>
            </div>
            {{-- <div class="flex w-1/2 flex-wrap">

                @foreach ($tipe_user as $user)
                    <div class="flex-1 p-4 m-2 bg-white rounded-lg shadow-md text-center min-w-[200px]">
                        <p class="text-sm text-gray-500">{{ $user['title'] }}</p>
                        <p class="text-2xl font-semibold">{{ $user['fungsi'] }}</p>
                        <p class="text-red-500 text-sm mt-1">-112.4%</p>
                    </div>
                @endforeach
            </div> --}}

        </div>
    </div>

    <!-- Charts Section -->
    <div class="flex flex-wrap gap-4 mb-6 p-8">
        <!-- Contextual Pie Chart -->
        <div class="flex-1 bg-white p-4 rounded-lg shadow-md w-40">
            <p class="text-lg font-semibold mb-4">Role User</p>
            <canvas id="contextualChart"></canvas>
        </div>



        <!-- Contextual Pie Chart -->
        <div class="flex-1 bg-white p-4 rounded-lg shadow-md w-40">
            <p class="text-lg font-semibold mb-4">Data Siswa By Unit</p>
            <canvas id="resonanceChart"></canvas>
        </div>
    </div>

    <!-- Spend by Channel Bar Chart -->
    <div class="flex flex-wrap bg-white p-4 rounded-lg shadow-md mb-6">
        <p class="text-lg font-semibold w-full mb-4">Spend by Channel</p>
        <div class="w-full">
            <canvas id="spendChart"></canvas>
        </div>
    </div>


    </div>


</x-layout-tupusat>

<script>
    // Device Type Chart (Doughnut)
    const ctxDevice = document.getElementById('contextualChart');
    new Chart(ctxDevice, {
        type: 'doughnut',
        data: {
            labels: ['Mobile', 'Desktop', 'Tablet'],
            datasets: [{
                data: [45, 50, 5],
                backgroundColor: ['#f472b6', '#818cf8', '#34d399'],
            }]
        }
    });

    // Impression Chart (Line)
    const ctxImpression = document.getElementById('impressionChart');
    new Chart(ctxImpression, {
        type: 'line',
        data: {
            labels: ['Jun 16', 'Jun 17', 'Jun 18', 'Jun 19', 'Jun 20', 'Jun 21'],
            datasets: [{
                label: 'Impressions',
                data: [300, 400, 200, 500, 350, 400],
                borderColor: '#818cf8',
                backgroundColor: 'rgba(129, 140, 248, 0.2)',
                fill: true
            }]
        }
    });

    // Spend Chart (Bar)
    const ctxSpend = document.getElementById('spendChart');
    new Chart(ctxSpend, {
        type: 'bar',
        data: {
            labels: ['Meta', 'Google', 'YouTube', 'Amazon', 'Xandr'],
            datasets: [{
                label: 'Spend ($)',
                data: [8000, 9000, 12000, 11000, 7000],
                backgroundColor: '#f472b6'
            }]
        }
    });

    // Resonance Chart (Polar Area)
    const ctxResonance = document.getElementById('resonanceChart');
    new Chart(ctxResonance, {
        type: 'polarArea',
        data: {
            labels: ['Creative A', 'Creative B', 'Creative C', 'Creative D'],
            datasets: [{
                data: [79, 82, 54, 67],
                backgroundColor: ['#f472b6', '#818cf8', '#34d399', '#fbbf24']
            }]
        }
    });
</script>
