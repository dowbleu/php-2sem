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

        ?>
    </section>

    <section class="task3">
        <h3>Задание 3 (СДО)</h3>
        <?php

        ?>

    </section>

    <section class="task4">
        <h3>Задание 4 (СДО)</h3>
        <?php

        ?>
    </section>

    <section class="task5">
        <h3>Задание 5 (СДО)</h3>
        <?php

        ?>
    </section>
</body>

</html>