<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pretest Quiz</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #1e1e2f;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #ffffff;
        }

        h1 {
            text-align: center;
            margin: 30px 0;
            font-weight: 600;
            color: #ffcc00;
        }

        .quiz-container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #2a2a40;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }

        .question {
            display: none;
        }

        .question.active {
            display: block;
        }

        legend {
            font-size: 1.2em;
            font-weight: 600;
            margin-bottom: 15px;
            color: #ffcc00;
        }

        .answer {
            background-color: #3a3a55;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .answer:hover {
            background-color: #ffcc00;
            color: #1e1e2f;
        }

        input[type="radio"] {
            display: none;
        }

        input[type="radio"]:checked+.answer {
            background-color: #ffcc00;
            color: #1e1e2f;
            box-shadow: 0 4px 10px rgba(255, 204, 0, 0.5);
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .pagination button {
            padding: 10px 20px;
            background-color: #ffcc00;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            color: #1e1e2f;
            transition: background 0.3s ease;
        }

        .pagination button:hover {
            background-color: #ffd633;
        }

        .pagination button:disabled {
            background-color: #3a3a55;
            color: #6c757d;
            cursor: not-allowed;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 15px;
            background: #ffcc00;
            color: #1e1e2f;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button[type="submit"]:hover {
            background: #ffd633;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(255, 204, 0, 0.5);
        }
    </style>
</head>

<body>
    <h1>Pretest Quiz</h1>

    <div class="quiz-container">
        <form id="quizForm" action="<?= site_url('module/submitPretest/' . $module_id) ?>" method="POST">
            <?php foreach ($questions as $index => $question): ?>
                <fieldset class="question <?= $index < 5 ? 'active' : '' ?>">
                    <legend><?= ($index + 1) . '. ' . $question['question_text'] ?></legend>

                    <?php foreach ($question['answers'] as $answer): ?>
                        <input type="radio" id="answer_<?= $answer['id'] ?>" name="question_<?= $question['id'] ?>" value="<?= $answer['id'] ?>">
                        <label class="answer" for="answer_<?= $answer['id'] ?>">
                            <span>🟢</span><?= $answer['answer'] ?>
                        </label>
                    <?php endforeach; ?>
                </fieldset>
            <?php endforeach; ?>

            <div class="pagination">
                <button type="button" id="prevButton" disabled>Previous</button>
                <button type="button" id="nextButton">Next</button>
            </div>

            <button type="submit" style="display: none;" id="submitButton">Submit Pretest</button>
        </form>
    </div>

    <script>
        const questions = document.querySelectorAll('.question');
        const nextButton = document.getElementById('nextButton');
        const prevButton = document.getElementById('prevButton');
        const submitButton = document.getElementById('submitButton');
        let currentPage = 0;
        const questionsPerPage = 5;

        function updatePagination() {
            questions.forEach((q, index) => {
                q.classList.remove('active');
                if (index >= currentPage * questionsPerPage && index < (currentPage + 1) * questionsPerPage) {
                    q.classList.add('active');
                }
            });

            prevButton.disabled = currentPage === 0;
            if ((currentPage + 1) * questionsPerPage >= questions.length) {
                nextButton.style.display = 'none';
                submitButton.style.display = 'block';
            } else {
                nextButton.style.display = 'block';
                submitButton.style.display = 'none';
            }
        }

        nextButton.addEventListener('click', () => {
            currentPage++;
            updatePagination();
        });

        prevButton.addEventListener('click', () => {
            currentPage--;
            updatePagination();
        });

        updatePagination();
    </script>
</body>

</html>