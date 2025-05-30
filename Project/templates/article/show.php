<?php require(dirname(__DIR__) . '/header.php'); ?>
<div class="content-wrapper">
    <article class="article-container">
        <h1 class="mb-3"><?= $article->getName() ?></h1>
        <div class="meta mb-4">
            Опубликовано <?= $article->getCreatedAt() ?>
            <?php
            $author = $article->getAuthor();
            if ($author !== null) {
                echo ' автором ' . $author->getName();
            } else {
                echo ' (автор не указан)';
            }
            ?>
        </div>
        <div class="lead mb-4"><?= nl2br(htmlspecialchars($article->getText())) ?></div>
        <div class="mb-4">
            <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/article/<?= $article->getId(); ?>/edit" class="btn btn-primary me-2">Редактировать</a>
            <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/article/<?= $article->getId(); ?>/delete" class="btn btn-danger">Удалить</a>
        </div>
    </article>

    <section class="comments">
        <h2 class="mb-4">Комментарии</h2>

        <?php foreach ($article->getComments() as $comment): ?>
            <div class="comment" id="comment<?= $comment->getId(); ?>">
                <?php
                $commentAuthor = $comment->getAuthor();
                if ($commentAuthor !== null) {
                    echo '<strong>' . $commentAuthor->getName() . ':</strong>';
                } else {
                    echo '<strong>(автор не указан):</strong>';
                }
                ?>
                <p class="mb-2"><?= nl2br(htmlspecialchars($comment->getText())); ?></p>
                <p class="comment-date text-muted small mb-2"><?= $comment->getCreatedAt(); ?></p>
                <div class="comment-actions">
                    <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/comments/<?= $comment->getId(); ?>/edit" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                    <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/comments/<?= $comment->getId(); ?>/delete" class="btn btn-sm btn-outline-danger">Удалить</a>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if (empty($article->getComments())): ?>
            <p class="text-muted">Пока нет комментариев.</p>
        <?php endif; ?>
    </section>

    <section class="add-comment">
        <h2 class="mb-3">Оставить комментарий</h2>
        <form action="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/article/<?= $article->getId(); ?>/comments" method="post">
            <div class="mb-3">
                <label for="text" class="form-label">Комментарий</label>
                <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Опубликовать</button>
        </form>
    </section>
</div>
<?php require(dirname(__DIR__) . '/footer.php'); ?>