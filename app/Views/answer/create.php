<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Answer</title>
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
                    <h2 class="text-center mb-4">Create Answer</h2>
                    <form action="<?= site_url('answer/store/' . $question_id) ?>" method="POST">
                        <div class="mb-3">
                            <label for="answer" class="form-label">Answer Text</label>
                            <input type="text" id="answer" name="answer" class="form-control" placeholder="Enter answer text" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correct Answer?</label>
                            <div class="d-flex gap-3">
                                <div>
                                    <input type="radio" id="correct_yes" name="is_correct" value="1" required>
                                    <label for="correct_yes">Yes</label>
                                </div>
                                <div>
                                    <input type="radio" id="correct_no" name="is_correct" value="0" required>
                                    <label for="correct_no">No</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Save Answer</button>
                    </form>
                    <a href="<?= site_url('question/' . $module_id) ?>"
                        class="btn btn-outline-primary d-flex align-items-center gap-2 mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path fill-rule="evenodd"
                                d="M8 12a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 1 0v7a.5.5 0 0 1-.5.5z" />
                            <path fill-rule="evenodd"
                                d="M4.854 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 8l2.855 2.854a.5.5 0 0 1-.708.708l-3-3z" />
                        </svg>
                        Back to Questions List
                    </a>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>