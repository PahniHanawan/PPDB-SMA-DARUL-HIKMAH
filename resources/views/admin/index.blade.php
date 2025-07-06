<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="row">
        @foreach ([['total', 'warning', 'Total Calon Pendaftar', 'fas fa-users'], ['accepted', 'success', 'Pendaftar Diterima', 'fas fa-user-check'], ['pending', 'info', 'Menunggu Verifikasi', 'fas fa-user-clock'], ['rejected', 'danger', 'Pendaftar Ditolak', 'fas fa-user-times']] as [$key, $color, $label, $icon])
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-{{ $color }} shadow-sm rounded-3 position-relative overflow-hidden">

                    <div class="inner p-4 text-white">
                        <h3 class="fw-bold">{{ $statistics[$key] }}</h3>
                        <p class="mb-0">{{ $label }}</p>
                    </div>

                    <div class="icon position-absolute top-0 end-0 m-3">
                        <i class="{{ $icon }} text-white opacity-75" style="font-size: 4rem;"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <div class="row">
        <!-- Chart Pendaftar Per Bulan -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Total Pendaftar per Bulan (1 Tahun Terakhir)</h3>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Chart Statistik Pendaftar -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Status Pendaftaran Chart</h3>
                </div>
                <div class="card-body">
                    <canvas id="userChart"></canvas>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Chart Pendaftaran per Bulan
            var ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
            new Chart(ctxMonthly, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($months) !!}, // Label bulan
                    datasets: [{
                        label: 'Total Pendaftar',
                        data: {!! json_encode($totals) !!}, // Data total per bulan
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Chart Pendaftar per Status per Bulan
            var ctxUser = document.getElementById('userChart').getContext('2d');
            new Chart(ctxUser, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($months) !!}, // Label bulan
                    datasets: [{
                            label: 'Diterima',
                            data: {!! json_encode($acceptedCounts) !!},
                            backgroundColor: 'rgba(40, 167, 69, 0.5)',
                            borderColor: 'rgba(40, 167, 69, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Pending',
                            data: {!! json_encode($pendingCounts) !!},
                            backgroundColor: 'rgba(23, 162, 184, 0.5)',
                            borderColor: 'rgba(23, 162, 184, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Ditolak',
                            data: {!! json_encode($rejectedCounts) !!},
                            backgroundColor: 'rgba(220, 53, 69, 0.5)',
                            borderColor: 'rgba(220, 53, 69, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

</x-layout>
