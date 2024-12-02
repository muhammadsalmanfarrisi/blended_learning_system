<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Question</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            width: 100%;
            max-width: 600px;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        textarea {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            resize: vertical;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            padding: 12px;
            font-size: 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-link {
            text-align: center;
            display: block;
            margin-top: 20px;
            font-weight: 600;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Create Question</h1>
        <form action="<?= site_url('question/store/' . $module_id) ?>" method="POST">
            <label for="question">Question:</label>
            <textarea name="question" id="question" rows="4" required></textarea>

            <input type="hidden" name="module_id" value="<?= $module_id ?>">

            <button type="submit">Save Question</button>
        </form>

        <a href="<?= site_url('question/' . $module_id) ?>" class="back-link">Back to Questions List</a>
    </div>
</body>

</html>
