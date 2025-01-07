<div class="card">
    <div class="card-header bg-success text-white text-center">
        <h5 class="mb-0">Top Requested Products</h5>
    </div>
    <div class="card-body chart-container" wire:ignore>
        <canvas id="topVotedChart"></canvas>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let chart;
            const ctx = document.getElementById('topVotedChart').getContext('2d');

            Livewire.on('chartUpdated', (chartData) => {

                let labels = chartData[0];
                let data= chartData[1];
                if (chart) {
                    chart.destroy(); // Destroy the previous chart instance
                }

                chart = new Chart(ctx, {
                                        type: 'bar', // Keep the bar chart type
                                        data: {
                                            labels: labels,
                                            datasets: [{
                                                label: 'Votes',
                                                data: data,
                                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                borderColor: 'rgba(75, 192, 192, 1)',
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            indexAxis: 'y', // Horizontal bar
                                            maintainAspectRatio: true,
                                            responsive: true,
                                            scales: {
                                                x: {
                                                    beginAtZero: true,
                                                    ticks: {
                                                        stepSize: 1, // Ensure each tick represents one vote
                                                    }
                                                },
                                                y: {
                                                    ticks: {
                                                        autoSkip: false, // Prevent skipping labels
                                                    }
                                                }
                                            },
                                            plugins: {
                                                legend: {
                                                    display: true,
                                                    position: 'top',
                                                },
                                                tooltip: {
                                                    enabled: true,
                                                }
                                            }
                                        }
                                    });
            });
        });
    </script>
</div>
