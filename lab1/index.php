<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аргунов Денис Сергеевич 241-321 Lab1</title>
</head>
<body>
    <section class="task1">
        <h3>Задание 1 (СДО)</h3>
        <?php 
            $a_task1 = 27;
            echo "Первый катет равен {$a_task1}<br>";
            $b_task1 = 12;
            echo "Второй катет равен {$b_task1}<br>";

            // Вычисление длины гипотенузы
            $c_task1 = sqrt(($a_task1 ** 2) + ($b_task1 ** 2));
            $c_task1_round = round($c_task1, 2);

            echo "Гипотенуза равна {$c_task1_round}";
        ?>
    </section>

    <section class="task2">
        <h3>Задание 2 (СДО)</h3>
        <?php
            $b_task2 = sqrt($c_task1_round ** 2 - $a_task1 ** 2);
            $b_task2_round = round($b_task2, 2);
            echo "Первый катет равен {$a_task1}<br>";
            echo "Гипотенуза равна {$c_task1_round}<br>";
            echo "Тогда второй катет равен {$b_task2_round}";
        ?>
    </section>

    <section class="task3And4">
        <h3>Задание 3-4 (СДО)</h3>
        <?php
            $c_task3 = 27;
            echo "Гипотенуза равна {$c_task3}<br>";
            $a_task3 = 23;
            echo "Первый катет равен {$a_task3}<br>";

            // Вычисление длины второго катета
            $b_task3 = sqrt($c_task3 ** 2 - $a_task3 ** 2);
            $b_task3_round = round($b_task3, 2);
            echo "Второй катет равен {$b_task3_round}<br>";
            echo "<br>";

            // Вычисление углов в радианах
            $a_angle = asin($a_task3 / $c_task3);  // угол напротив катета a
            $b_angle = asin($b_task3 / $c_task3);  // угол напротив катета b

            // Перевод радиан в градусы и округление
            $a_angle_deg = round(rad2deg($a_angle), 2);
            $b_angle_deg = round(rad2deg($b_angle), 2);
            $c_angle_deg = 90;

            echo "Угол напротив катета a: {$a_angle_deg}°<br>";
            echo "Угол напротив катета b: {$b_angle_deg}°<br>";
            echo "Проверка суммы углов: " . round($a_angle_deg + $b_angle_deg, 2) . "° (должно быть 90°)<br>";
            echo "Угол напротив гипотенузы: {$c_angle_deg}°";
        ?>
    </section>

    <section class="task10">
        <h3>Задание 10 (СДО)</h3>
        <?php
            $hunter = "охотник";
            $wants_to = 'желает';
            $know = 'знать';
            $fizan = 'фазан';
            $sits = 'сидит';

            echo "<h4>Дано:</h4>";
            echo "\$hunter = '$hunter'<br>";
            echo "\$wants_to = '$wants_to'<br>";
            echo "\$know = '$know'<br>";
            echo "\$fizan = '$fizan'<br>";
            echo "\$sits = '$sits'<br><br>";

            echo "Итоговая фраза: <i>Каждый {$hunter} {$wants_to} {$know}, где {$sits} {$fizan}!</i>"
        ?>
    </section>
</body>
</html>