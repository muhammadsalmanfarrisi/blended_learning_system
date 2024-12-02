<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pretest Result</title>
</head>

<body>
    <h1>Pretest Result</h1>

    <?php if ($result): ?>
        <p>Your score: <?= $result['score'] ?> / <?= count($result['questions']) ?></p>
    <?php else: ?>
        <p>No result found. It looks like you haven't taken the pretest yet.</p>
    <?php endif; ?>

    <br>
    <a href="<?= site_url('module/view/' . $module_id) ?>">Back to Module</a>
</body>

</html>