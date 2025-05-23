<?php
function editRecord($mysqli)
{
    $msg = '';

    // проверка, есть ли id записи в GET
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id <= 0) {
        return '<p style="color:red;">Ошибка: Не указан корректный ID записи.</p>';
    }

    // если форма отправлена на редактирование
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button']) && $_POST['button'] === 'Сохранить') {
        // получаем данные из формы и экранируем
        $surname = $mysqli->real_escape_string(trim($_POST['surname'] ?? ''));
        $name = $mysqli->real_escape_string(trim($_POST['name'] ?? ''));
        $lastname = $mysqli->real_escape_string(trim($_POST['lastname'] ?? ''));
        $date = $mysqli->real_escape_string(trim($_POST['date'] ?? ''));
        $phone = $mysqli->real_escape_string(trim($_POST['phone'] ?? ''));
        $location = $mysqli->real_escape_string(trim($_POST['location'] ?? ''));
        $email = $mysqli->real_escape_string(trim($_POST['email'] ?? ''));
        $comment = $mysqli->real_escape_string(trim($_POST['comment'] ?? ''));

        // проверяем обязательные поля
        if ($surname === '' || $name === '') {
            $msg = '<p style="color:red;">Ошибка: Фамилия и Имя обязательны для заполнения.</p>';
        } else {
            // Обновляем запись
            $sql = "UPDATE contacts SET 
                        surname='$surname',
                        name='$name',
                        lastname='$lastname',
                        date='$date',
                        phone='$phone',
                        location='$location',
                        email='$email',
                        comment='$comment'
                    WHERE id = $id";

            if ($mysqli->query($sql)) {
                $msg = '<p style="color:green;">Запись успешно обновлена.</p>';
            } else {
                $msg = '<p style="color:red;">Ошибка БД: ' . htmlspecialchars($mysqli->error) . '</p>';
            }
        }
    }

    // здесь мы получаем текущие данные записи для вывода в форму
    $sql = "SELECT * FROM contacts WHERE id = $id";
    $result = $mysqli->query($sql);

    if (!$result || $result->num_rows === 0) {
        return '<p style="color:red;">Ошибка: Запись не найдена.</p>';
    }

    $row = $result->fetch_assoc();

    // если у нас была отправка формы с ошибками, то мы берем значения из POST, в противном случае - из бд
    $surnameVal = $_POST['surname'] ?? $row['surname'];
    $nameVal = $_POST['name'] ?? $row['name'];
    $lastnameVal = $_POST['lastname'] ?? $row['lastname'];
    $dateVal = $_POST['date'] ?? $row['date'];
    $phoneVal = $_POST['phone'] ?? $row['phone'];
    $locationVal = $_POST['location'] ?? $row['location'];
    $emailVal = $_POST['email'] ?? $row['email'];
    $commentVal = $_POST['comment'] ?? $row['comment'];

    return <<<HTML
<h2>Редактировать запись #$id</h2>
$msg
<form method="post">
    <div class="column">
        <div class="add">
            <label>Фамилия</label> 
            <input type="text" name="surname" placeholder="Фамилия" value="{$surnameVal}">
        </div>
        <div class="add">
            <label>Имя</label> 
            <input type="text" name="name" placeholder="Имя" value="{$nameVal}">
        </div>
        <div class="add">
            <label>Отчество</label> 
            <input type="text" name="lastname" placeholder="Отчество" value="{$lastnameVal}">
        </div>
        <div class="add">
            <label>Дата рождения</label> 
            <input type="date" name="date" value="{$dateVal}">
        </div>
        <div class="add">
            <label>Телефон</label> 
            <input type="text" name="phone" placeholder="Телефон" value="{$phoneVal}">
        </div>
        <div class="add">
            <label>Адрес</label> 
            <input type="text" name="location" placeholder="Адрес" value="{$locationVal}">
        </div>
        <div class="add">
            <label>Email</label> 
            <input type="email" name="email" placeholder="Email" value="{$emailVal}">
        </div>
        <div class="add">
            <label>Комментарий</label> 
            <textarea name="comment" placeholder="Краткий комментарий">{$commentVal}</textarea>
        </div>

        <div class="form-inf">
            <span>* - обязательные поля</span>
            <button type="submit" value="Сохранить" name="button" class="form-btn">Сохранить</button>
        </div>
    </div>
</form>
HTML;
}
