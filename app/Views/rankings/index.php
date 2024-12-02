<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Rankings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            flex: 1;
        }

        footer {
            text-align: center;
            padding: 10px;
            background: #f1f1f1;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <?= view('layout/header'); ?>

        <div class="card container-fluid bg-primary text-white py-5" style="background-image: url('<?= base_url('images/bg_modul.jpg'); ?>'); background-size: cover; background-position: center;">
            <div class="container text-center">
                <!-- Main Title Section with Subtle Text Shadow -->
                <h1 class="display-3 font-weight-bold mb-4" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6); background-color: rgba(0, 0, 0, 0.5); padding: 10px;">
                    Ranking Peserta Pelatihan
                </h1>

                <!-- Subtitle Section with Subtle Text Shadow -->
                <p class="lead mb-4" style="font-size: 1.25rem; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6); background-color: rgba(0, 0, 0, 0.5); padding: 8px;">
                    Tetap Semangat dan Selalu Berusaha Lebih Baik
                </p>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-center">
                    <a href="#modul" class="btn btn-light btn-lg mx-2" style="text-transform: uppercase; padding: 12px 30px; font-size: 1.1rem;">
                        Lihat Ranking
                    </a>

                </div>
            </div>
        </div><br>
        <div class="container">
            <h1 class="text-center table-title">User Rankings</h1>
            <div class="table-responsive ranking-table">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>User</th>
                            <th>Average Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($rankings)): ?>
                            <?php foreach ($rankings as $index => $ranking): ?>
                                <tr>
                                    <td><strong>#<?= $index + 1 ?></strong></td>
                                    <td><?= esc($ranking['username']) ?></td>
                                    <td><?= number_format($ranking['average_score'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">No rankings available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?= view('layout/footer'); ?>
    </div>

</body>

</html>