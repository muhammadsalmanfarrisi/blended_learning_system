<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Questions & Answers</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            font-weight: 600;
            color: #555;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .question-item {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fafafa;
        }

        .question-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .question-text {
            font-size: 1.2em;
            font-weight: 600;
            color: #444;
        }

        .question-actions a {
            margin-left: 10px;
            padding: 5px 10px;
            font-size: 0.9em;
            color: #fff;
            text-decoration: none;
            background-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .question-actions a:hover {
            background-color: #0056b3;
        }

        .answers {
            margin-top: 15px;
        }

        .answers h4 {
            font-size: 1em;
            margin-bottom: 10px;
            color: #555;
        }

        .answer-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin-bottom: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }

        .answer-item span.correct {
            color: #28a745;
            font-weight: 600;
        }

        .answer-item-actions a {
            margin-left: 5px;
            padding: 5px 8px;
            font-size: 0.8em;
            color: #fff;
            text-decoration: none;
            background-color: #17a2b8;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .answer-item-actions a:hover {
            background-color: #117a8b;
        }

        .add-answer {
            display: inline-block;
            margin-top: 10px;
            padding: 7px 15px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .add-answer:hover {
            background-color: #218838;
        }

        .add-question {
            display: block;
            margin: 30px auto;
            padding: 15px 20px;
            text-align: center;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1em;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .add-question:hover {
            background-color: #0056b3;
        }

        /* Modify the delete button color */
        .question-actions a.delete-button {
            background-color: #dc3545;
            /* Red background */
            color: #fff;
        }

        .question-actions a.delete-button:hover {
            background-color: #c82333;
            /* Darker red on hover */
        }

        /* Modify the delete button color for answers */
        .answer-item-actions a.delete-button {
            background-color: #dc3545;
            /* Red background */
            color: #fff;
        }

        .answer-item-actions a.delete-button:hover {
            background-color: #c82333;
            /* Darker red on hover */
        }
    </style>
</head>

<body>
    <h1>Manage Questions & Answers</h1>

    <div class="container">
        <a href="<?= site_url('module/view/' . $module_id) ?>" class="back-to-modules">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path fill-rule="evenodd" d="M8 12a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 1 0v7a.5.5 0 0 1-.5.5z" />
                <path fill-rule="evenodd" d="M4.854 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 8l2.855 2.854a.5.5 0 0 1-.708.708l-3-3z" />
            </svg>
            Back to Modules
        </a>
        <br><br>

        <?php foreach ($questions as $question): ?>
            <div class="question-item">
                <div class="question-header">
                    <div class="question-text"><?= $question['question_text'] ?></div>
                    <div class="question-actions">
                        <div class="question-actions">
                            <a href="<?= site_url('question/edit/' . $question['id']) ?>">Edit</a>
                            <!-- Add the 'delete-button' class to the delete button -->
                            <a href="<?= site_url('question/delete/' . $question['id']) ?>" class="delete-button" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>

                    </div>
                </div>

                <div class="answers">
                    <h4>Answers:</h4>
                    <?php foreach ($question['answers'] as $answer): ?>
                        <div class="answer-item">
                            <div>
                                <?= $answer['answer'] ?>
                                <?php if ($answer['is_correct']): ?>
                                    <span class="correct">(Correct)</span>
                                <?php endif; ?>
                            </div>
                            <div class="answer-item-actions">
                                <div class="answer-item-actions">
                                    <a href="<?= site_url('answer/edit/' . $answer['id']) ?>">Edit</a>
                                    <!-- Add the 'delete-button' class to the delete button -->
                                    <a href="<?= site_url('answer/delete/' . $answer['id']) ?>" class="delete-button" onclick="return confirm('Are you sure?')">Delete</a>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                    <a href="<?= site_url('answer/create/' . $question['id']) ?>" class="add-answer">Add Answer</a>
                </div>
            </div>
        <?php endforeach; ?>

        <a href="<?= site_url('question/create/' . $module_id) ?>" class="add-question">Add New Question</a>
    </div>
</body>

</html>