<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аргунов Денис Сергеевич 241-321 Lab6</title>
</head>

<body>
    <h1>6.1. Сессии и куки</h1>
    <h2>Выполнил: Аргунов Денис Сергеевич (241-321)</h2>

    <section class="task1">
        <h3>Задание 1 (СДО)</h3>
        <?php
        session_start();

        if (!isset($_SESSION['test'])) {
            $_SESSION['test'] = 'test';
            echo "Данные записаны в сессию. Обнови страницу!";
        } else {
            echo "Содержимое сессии: " . $_SESSION['test'];
        }
        ?>
    </section>

    <section class="task2">
        <h3>Задание 2 (СДО)</h3>
        <?php
        $_SESSION['message'] = 'куку!';

        echo "Данные записаны в сессию.<br>";
        echo '<a href="task2.php">Перейти на вторую страницу</a>';
        ?>
    </section>

    <section class="task3">
        <h3>Задание 3 (СДО)</h3>
        <?php
        if (!isset($_SESSION['counter'])) {
            $_SESSION['counter'] = 0;
            echo "Йоу, чувачок, ты еще не обновил страницу. Обнови сейчас!";
        } else {
            $_SESSION['counter']++;
            echo "Круто! Теперь ты обновил страницу " . $_SESSION['counter'] . " раз(а).";
        }
        ?>

    </section>

    <section class="task4">
        <h3>Задание 4 (СДО)</h3>
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $_SESSION['country'] = htmlspecialchars($_POST['country']);
                echo "Твоя страна сохранена в сессии! Вот же она: " . $_SESSION['country'] . "<br>";
                echo '<a href="test.php">Перейти на test.php</a>';
            } else {
        ?>

        <form method="POST" action="">
            <label for="country">Введи свою страну, слон:</label>
            <input type="text" name="country" id="country" required>
            <button type="submit">Сохранить</button>
        </form>

        <?php
        }
        ?>
    </section>

    <section class="task5">
        <h3>Задание 5 (СДО)</h3>
        <?php
            if (!isset($_SESSION['time'])) {
                $_SESSION['time'] = time();
                echo "Привет, ты только что зашел на сайт!";
            } else {
                $time_now = time();
                $seconds_passed = $time_now - $_SESSION['time'];
                echo "Ты зашел на сайт " . $seconds_passed . " секунд назад.";
            }
        ?>
    </section>
</body>

</html>