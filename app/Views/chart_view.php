<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h3>Grafik Nilai per Hari</h3>
        </div>
        <div class="card-body">
            <div class="chart-wrapper" style="display: flex; justify-content: center; align-items: center; height: 80vh;">
                <div class="chart-container" style="position: relative; height: 500px; width: 80%; margin: auto;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        <div class="row justify-content-center my-5">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0"><i class="fas fa-trophy"></i> Your Current Ranking</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($userRanking): ?>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="text-center">
                                    <h4 class="text-success"><i class="fas fa-medal"></i> Position</h4>
                                    <p class="mb-0 display-4">#<?= $userPosition ?></p>
                                </div>
                                <div class="text-center">
                                    <h4 class="text-warning"><i class="fas fa-chart-line"></i> Average Score</h4>
                                    <p class="mb-0 display-4"><?= number_format($userRanking['average_score'], 2) ?></p>
                                </div>
                            </div>
                            <div class="progress my-4" style="height: 20px;">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                    style="width: <?= $userRanking['average_score'] ?>%;"
                                    aria-valuenow="<?= $userRanking['average_score'] ?>"
                                    aria-valuemin="0"
                                    aria-valuemax="100">
                                    <?= number_format($userRanking['average_score'], 2) ?>%
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info text-center" role="alert">
                                <i class="fas fa-info-circle"></i> You have not completed any modules yet.
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <small>Keep learning to improve your ranking!</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer text-center text-muted">
            <small>© 2024 - Sistem Monitoring</small>
        </div>
    </div>
</div>

<script>
    // Ambil data dari PHP
    const days = <?= json_encode($days); ?>; // Data hari (1-10)
    const values = <?= json_encode($values); ?>; // Data nilai per hari

    // Array warna variatif untuk batang
    const colors = [
        'rgba(75, 192, 192, 0.8)',
        'rgba(255, 99, 132, 0.8)',
        'rgba(255, 159, 64, 0.8)',
        'rgba(153, 102, 255, 0.8)',
        'rgba(54, 162, 235, 0.8)',
        'rgba(255, 206, 86, 0.8)',
        'rgba(75, 192, 192, 0.8)',
        'rgba(255, 159, 64, 0.8)',
        'rgba(153, 102, 255, 0.8)',
        'rgba(54, 162, 235, 0.8)'
    ];

    // Konfigurasi grafik
    const ctx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: days.map(day => `Hari ${day}`), // Label Hari
            datasets: [{
                label: 'Nilai per Hari',
                data: values,
                backgroundColor: colors,
                borderColor: colors.map(color => color.replace('0.8', '1')),
                borderWidth: 2,
                borderRadius: 10,
                hoverBackgroundColor: colors.map(color => color.replace('0.8', '1')),
                hoverBorderColor: 'rgba(0, 0, 0, 0.5)',
                hoverBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: {
                        color: 'rgba(200, 200, 200, 0.2)',
                        borderDash: [5, 5]
                    },
                    ticks: {
                        color: 'rgba(0, 0, 0, 0.7)',
                        font: {
                            size: 14
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    suggestedMin: 80,
                    suggestedMax: 90,
                    grid: {
                        color: 'rgba(200, 200, 200, 0.2)',
                        borderDash: [5, 5]
                    },
                    ticks: {
                        stepSize: 1,
                        color: 'rgba(0, 0, 0, 0.7)',
                        font: {
                            size: 14
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: 'rgba(0, 0, 0, 0.8)',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(54, 54, 54, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    cornerRadius: 10,
                    borderColor: 'rgba(255, 255, 255, 0.5)',
                    borderWidth: 2,
                    padding: 10
                }
            }
        }
    });
</script>

<?= $this->endSection(); ?>