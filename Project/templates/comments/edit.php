<?php require(dirname(__DIR__) . '/header.php'); ?>
<section class="edit-comment">
    <h2>Редактировать комментарий</h2>
    <form action="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/comments/<?= $comment->getId(); ?>/update" method="post">
        <div class="mb-3">
            <label for="text" class="form-label">Комментарий</label>
            <textarea class="form-control" id="text" name="text" rows="3"><?= htmlspecialchars($comment->getText()) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
</section>
<?php require(dirname(__DIR__) . '/footer.php'); ?>