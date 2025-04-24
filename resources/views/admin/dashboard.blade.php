<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<x-layout-admin>
    <x-slot name="header">

    </x-slot>
    <div class="bg-gray-100">
        <div class="flex flex-col w-full px-60">
            <div class="flex p-8 gap-4 mb-6 flex-row items-stretch w-full">
                <div class="flex flex-col w-full h-85 justify-between">
                    <div class="flex-1 p-4">
                        <p class="text-lg font-semibold mb-4">Total User By: Unit Pendidikan</p>
                        <canvas id="impressionChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="flex p-8 gap-4 mb-6 flex-row items-stretch">
                <div class="flex flex-col w-1/2 h-full justify-between">
                    <div class="flex-1 p-4">
                    </div>
                    <div class="flex-1 p-4 m-2 mb-6 bg-white rounded-lg shadow-md text-center ]">
                        <p class="text-sm text-gray-500">Jumlah Total User</p>
                        <p class="text-2xl font-semibold">{{ $users }}</p>
                    </div>

                </div>
                <div class="flex flex-col w-1/2 h-full justify-between ">
                    <div class="flex-1 p-4">
                    </div>
                    <div class="flex-1 p-4 m-2 mb-6 bg-white rounded-lg shadow-md text-center ]">
                        <p class="text-sm text-gray-500">Jumlah Total Siswa</p>
                        <p class="text-2xl font-semibold">$11.675 M</p>
                    </div>
                </div>
            </div>

            <div class="flex p-8 gap-4 mb-6 flex-row items-stretch">
                <div class="flex flex-col w-1/2 h-full justify-between">
                    <div class="flex-1 p-4">
                    </div>
                    <!-- Contextual Pie Chart -->
                <div class="flex-1 p-4 m-2 m bg-white rounded-lg shadow-md text-center min-w-[200px]">
                        <p class="text-lg font-semibold mb-4">Role User</p>
                        <canvas id="contextualChart"></canvas>
                    </div>
                </div>

                <div class="flex flex-col w-1/2 h-full justify-between ">
                    <div class="flex-1 p-4">
                    </div>
                    <!-- Contextual Pie Chart -->
                    <div class="flex-1 p-4 m-2 m bg-white rounded-lg shadow-md text-center min-w-[200px]">
                        <p class="text-lg font-semibold mb-4">Data Siswa By Unit</p>
                        <canvas id="resonanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>






    </div>

</x-layout-admin>

<script>
    let data = @json($listOfAllRole);
    const ctxDevice = document.getElementById('contextualChart');
    new Chart(ctxDevice, {
        type: 'pie',
        data: {
            labels: ['ADMIN', 'TU PUSAT]', 'TU UNIT'],
            datasets: [{
                data: [data.admin, data.tupusat, data.tuunit, ],
                backgroundColor: ['#f472b6', '#818cf8', '#34d399'],
            }]
        }
    });

    // Impression Chart (Line)
    let dataUnit= @json($listOfAllUnit);
    // alert($listOfAllUnit);
    const ctxImpression = document.getElementById('impressionChart');
    new Chart(ctxImpression, {
        type: 'line',
        data: {
            labels: ['TK','SD','SMP','SMA','TPQ','PONDOK','MADIN'],
            datasets: [{
                label: 'Impressions',
                data: [dataUnit.TK, dataUnit.SD, dataUnit.SMP, dataUnit.SMA, dataUnit.MADIN, dataUnit.TPQ, dataUnit.PONDOK],
                borderColor: '#818cf8',
                backgroundColor: 'rgba(129, 140, 248, 0.2)',
                fill: true,
                // lineColor: '#000';
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
