<?php
function deleteRecord($mysqli)
{
    $msg = '';

    // проверяем, есть ли id записи для удаления в GET
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id <= 0) {
        return '<p style="color:red;">Ошибка: Не указан корректный ID записи для удаления.</p>';
    }

    // если форма подтверждения удаления уже отправлена
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'Да') {
        // удаляем запись из бд :)
        $sql = "DELETE FROM contacts WHERE id=$id";
        if ($mysqli->query($sql)) {
            $msg = '<p style="color:green;">Запись успешно удалена.</p>';
            $msg .= '<p><a href="index.php?action=view">Вернуться к списку</a></p>';
            return $msg;
        } else {
            return '<p style="color:red;">Ошибка при удалении записи: ' . htmlspecialchars($mysqli->error) . '</p>';
        }
    }

    // получаем данные записи для показа пользователю (например, фамилию и имя)
    $sql = "SELECT surname, name FROM contacts WHERE id=$id LIMIT 1";
    $result = $mysqli->query($sql);
    if (!$result || $result->num_rows === 0) {
        return '<p style="color:red;">Ошибка: Запись не найдена.</p>';
    }
    $row = $result->fetch_assoc();

    // Форма подтверждения удаления
    return <<<HTML
<h2>Удаление записи</h2>
<p>Вы действительно хотите удалить запись: <strong>{$row['surname']} {$row['name']}</strong>?</p>
<form method="post">
    <button type="submit" name="confirm" value="Да" class="form-btn">Да</button>
    <a href="index.php?action=view" class="form-btn" style="font-family: Arial; display: inline-block; text-align: center; width: auto; height: auto; padding: 10px 40px;">Нет</a>
</form>
HTML;
}
