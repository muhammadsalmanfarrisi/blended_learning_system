<div class="container">
    <?php foreach ($answers as $answer): ?>
        <div class="question-item">
            <div>
                <?= $answer['answer'] ?> <?= $answer['is_correct'] ? '<span style="color:green">(Correct)</span>' : '' ?>
            </div>
            <div class="question-actions">
                <a href="<?= site_url('answer/edit/' . $answer['id']) ?>">Edit</a>
                <a href="<?= site_url('answer/delete/' . $answer['id']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </div>
        </div>
    <?php endforeach; ?>

    <a href="<?= site_url('answer/create/' . $question_id) ?>" class="add-question">Add New Answer</a>
</div>
