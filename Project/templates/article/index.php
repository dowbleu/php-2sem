<?php require(dirname(__DIR__) . '/header.php'); ?>
<div class="articles-list">
    <?php foreach ($articles as $article): ?>
        <article class="article-container">
            <h2 class="article-title">
                <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/article/<?= $article->getId() ?>"><?= $article->getName(); ?></a>
            </h2>
            <div class="meta">
                Опубликовано <?= $article->getCreatedAt(); ?> 
                <?php
                $author = $article->getAuthor();
                if ($author !== null) {
                    echo 'автором ' . $author->getName();
                } else {
                    echo '(автор не указан)';
                }
                ?>
            </div>
            <div class="article-preview">
                <?php
                $text = $article->getText();
                $maxLength = 300;
                if (mb_strlen($text) > $maxLength) {
                    $text = mb_substr($text, 0, $maxLength) . '...';
                }
                ?>
                <p><?= $text ?></p>
            </div>
            <a href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/article/<?= $article->getId() ?>" class="read-more">Читать далее</a>
        </article>
    <?php endforeach ?>
    <a class="btn-add" href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/article/create">Добавить</a>
</div>
<?php require(dirname(__DIR__) . '/footer.php'); ?>