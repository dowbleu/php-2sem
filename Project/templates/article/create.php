<?php require(dirname(__DIR__) . '/header.php'); ?>
<form action="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/article/store" method="post">
    <div class="mb-3">
        <label for="date" class="form-label">Дата</label>
        <input type="date" class="form-control" id="date" name="date">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Название</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Текст</label>
        <textarea class="form-control" id="text" rows="3" name="text"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Опубликовать</button>
</form>

<?php require(dirname(__DIR__) . '/footer.php'); ?>