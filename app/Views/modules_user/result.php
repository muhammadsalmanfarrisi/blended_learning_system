<?php
// File: app/Views/modules/result.php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .result-container {
            margin-top: 50px;
            background: #f4f6f9;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #f0f2f5;
            border-bottom: 2px solid #dee2e6;
        }

        .score-text {
            font-size: 2rem;
            font-weight: bold;
            color: #28a745;
        }

        .submitted-at {
            font-size: 1rem;
            color: #6c757d;
        }

        .module-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #343a40;
        }

        .progress-bar {
            height: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="result-container">
            <!-- Result Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="module-title"><?= esc($module['title']) ?></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Score Display -->
                        <div class="col-12 col-md-6">
                            <div class="score-text">
                                Score: <?= esc($result['score']) ?> / <?= count($questions) ?>
                            </div>
                        </div>

                        <!-- Submission Date -->
                        <div class="col-12 col-md-6 text-md-end">
                            <p class="submitted-at">
                                Submitted on: <?= esc(date('F j, Y, g:i a', strtotime($result['submitted_at']))) ?>
                            </p>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?= ($result['score'] / count($questions)) * 100 ?>%" aria-valuenow="<?= ($result['score'] / count($questions)) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="mt-4">
                        <a href="/modules" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Back to Modules
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Developed by Muhammad Salman Farrisi, Universitas Jenderal Soedirman</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>