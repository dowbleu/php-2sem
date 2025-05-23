<?php
function handleAdd($mysqli)
{
    $msg = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button']) && $_POST['button'] === 'Добавить') {
        // тут получаем данные из формы и экранируем их для безопасности
        $surname = $mysqli->real_escape_string(trim($_POST['surname'] ?? '')); // real_escape_string - экранируем специальные символы, чтоб не сломать SQL
        $name = $mysqli->real_escape_string(trim($_POST['name'] ?? ''));
        $lastname = $mysqli->real_escape_string(trim($_POST['lastname'] ?? ''));
        $date = $mysqli->real_escape_string(trim($_POST['date'] ?? ''));
        $phone = $mysqli->real_escape_string(trim($_POST['phone'] ?? ''));
        $location = $mysqli->real_escape_string(trim($_POST['location'] ?? ''));
        $email = $mysqli->real_escape_string(trim($_POST['email'] ?? ''));
        $comment = $mysqli->real_escape_string(trim($_POST['comment'] ?? ''));

        // здесь проверяем обязательные поля
        if ($surname === '' || $name === '') {
            $msg = '<p style="color:red;">Ошибка: Фамилия и Имя обязательны для заполнения.</p>';
        } else {
            // тут вставляем в бд 
            $sql = "INSERT INTO contacts (surname, name, lastname, date, phone, location, email, comment) VALUES 
                ('$surname', '$name', '$lastname', '$date', '$phone', '$location', '$email', '$comment')";

            if ($mysqli->query($sql)) {
                $msg = '<p style="color:green;">Запись успешно добавлена.</p>';
            } else {
                $msg = '<p style="color:red;">Ошибка БД: ' . htmlspecialchars($mysqli->error) . '</p>';
            }
        }
    }

    // подготавливаем значения, чтобы повторно вставить в форму, вдруг что-то вввелм неправильно (чтоб не переписывать форму)
    $surnameVal = $_POST['surname'] ?? '';
    $nameVal = $_POST['name'] ?? '';
    $lastnameVal = $_POST['lastname'] ?? '';
    $dateVal = $_POST['date'] ?? '';
    $phoneVal = $_POST['phone'] ?? '';
    $locationVal = $_POST['location'] ?? '';
    $emailVal = $_POST['email'] ?? '';
    $commentVal = $_POST['comment'] ?? '';

    return <<<HTML
<h2>Добавить новую запись</h2>
$msg
<form name="form_add" method="post">
    <div class="column">
        <div class="add">
            <label>Фамилия*</label> 
            <input type="text" name="surname" placeholder="Фамилия" value="{$surnameVal}">
        </div>
        <div class="add">
            <label>Имя*</label> 
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
            <button type="submit" value="Добавить" name="button" class="form-btn">Добавить</button>
        </div>
    </div>
</form>
HTML;
}
