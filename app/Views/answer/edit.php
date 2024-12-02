<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Answer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .back-link {
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h2 class="text-center mb-4">Edit Answer</h2>
                    <form action="<?= site_url('answer/update/' . $answer['id']) ?>" method="POST">
                        <div class="mb-3">
                            <label for="answer" class="form-label">Answer Text</label>
                            <input type="text" id="answer" name="answer" class="form-control" value="<?= esc($answer['answer']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correct Answer?</label>
                            <div class="d-flex gap-3">
                                <div>
                                    <input type="radio" id="correct_yes" name="is_correct" value="1" <?= $answer['is_correct'] == 1 ? 'checked' : '' ?> required>
                                    <label for="correct_yes">Yes</label>
                                </div>
                                <div>
                                    <input type="radio" id="correct_no" name="is_correct" value="0" <?= $answer['is_correct'] == 0 ? 'checked' : '' ?> required>
                                    <label for="correct_no">No</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Answer</button>
                    </form>
                    <a href="<?= site_url('question/' . $module_id) ?>" class="back-link d-block mt-3 text-center text-primary">Back to Questions List</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>