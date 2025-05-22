<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аргунов Денис Сергеевич 241-321 Lab4</title>
</head>

<body>
    <h1>4.1. Регулярные выражения</h1>
    <h2>Выполнил: Аргунов Денис Сергеевич (241-321)</h2>

    <section class="task1">
        <h3>Задание 1 (СДО)</h3>
        <?php
            $str_task1 = 'a1b2c3';
            $result_task1 = preg_replace('#(\d)#', '$1$1', $str_task1);
            echo $result_task1; // a11b22c33
        ?>
    </section>

    <section class="task2">
        <h3>Задание 2 (СДО)</h3>
        <?php
            $str_task2 = 'https://site.ru';

            if (preg_match('#https?://[a-z0-9\-]+\.[a-z]{2,6}#i', $str_task2)) {
                echo 'Your link is correct';
            } else {
                echo 'Your link isn\'t correct';
            }
        ?>
    </section>

    <section class="task3">
        <h3>Задание 3 (СДО)</h3>
        <?php
            $str_task3 = 'http://site.ru';

            if (preg_match('#^http://[a-z0-9\-]+\.[a-z]{2,6}#i', $str_task3)) {
                echo 'Your link is correct';
            } else {
                echo 'Your link isn\'t correct';
            }
        ?>

    </section>

    <section class="task4">
        <h3>Задание 4 (СДО)</h3>
        <?php
            $str_task4 = 'hello.site.ru';

            if (preg_match('#^[a-z0-9\-]+\.[a-z0-9\-]+\.[a-z]{2,6}$#i', $str_task4)) {
                echo 'Your link is correct';
            } else {
                echo 'Your link isn\'t correct';
            }
        ?>
    </section>

    <section class="task5">
        <h3>Задание 5 (СДО)</h3>
        <?php
            $str_task5 = 'site.ru';

            if (preg_match('#^[a-z0-9\-]+\.[a-z]{2,6}$#i', $str_task5)) {
                echo 'Your link is correct';
            } else {
                echo 'Your link isn\'t correct';
            }
        ?>
    </section>
</body>

</html>