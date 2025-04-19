<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аргунов Денис Сергеевич 241-321 Lab2</title>
</head>

<body>
    <h1>2.1. Массивы. Функции. GET & POST</h1>
    <h2>Выполнил: Аргунов Денис Сергеевич (241-321)</h2>

    <section class="task1">
        <h3>Задание 1 (СДО)</h3>
        <?php
            $array_task1 = array('a', 'b', 'c', 'b', 'a');
            echo "Дано: массив [" . implode(', ', $array_task1) . "]<br><br>";

            $array_task1_counted = array_count_values($array_task1);

            echo "Подсчет элементов в массиве: ";
            print_r($array_task1_counted);
        ?>
    </section>

    <section class="task2">
        <h3>Задание 2 (СДО)</h3>
        <?php
            $array_task2 = array('a' => 1, 'b' => 2, 'c' => 3);
            echo "Дано: массив [" . implode(', ', $array_task2) . "]<br><br>";

            $array_task2_flipped = array_flip($array_task2);
            echo "Массив после array_flip (ключи и значения поменялись местами): ";
            print_r($array_task2_flipped); print_r("<br>");

            $array_task2_reversed = array_reverse($array_task2_flipped, true); // true — чтобы сохранить ключи
            echo "Массив после array_reverse (обратный порядок): ";
            print_r($array_task2_reversed); print_r("<br>");
        ?>
    </section>

    <section class="task3">
        <h3>Задание 3 (СДО)</h3>
        <?php
            $array_task3 = array(1, 2, 3, 4, 5);
            echo "Дано: массив [" . implode(', ', $array_task3) . "]<br><br>";

            $array_task3_reversed = array_reverse($array_task3);
            echo "Массив после array_reverse (обратный порядок): ";
            echo "[" . implode(', ', $array_task3_reversed) . "]<br>";
        ?>
    </section>

    <section class="task4">
        <h3>Задание 4 (СДО)</h3>
        <?php
            $first_array_task4 = array('a', 'b', 'c');
            echo "Дано: Первый массив [" . implode(', ', $first_array_task4) . "]<br>";

            $second_array_task4 = array(1, 2, 3);
            echo "Дано: Второй массив [" . implode(', ', $second_array_task4) . "]<br><br>";

            $array_combined_task4 = array_combine($first_array_task4, $second_array_task4);
            echo "Результат после array_combine: ";
            print_r($array_combined_task4);

            echo "<br>Ключи массива: [" . implode(', ', array_keys($array_combined_task4)) . "]<br>";
            echo "Значения массива: [" . implode(', ', array_values($array_combined_task4)) . "]<br>";
        ?>
    </section>

    <section class="task5">
        <h3>Задание 5 (СДО)</h3>
        <?php
            $array_task5 = array('a' => 1, 'b' => 2, 'c' => 3);
            echo "Дано: массив [" . implode(', ', $array_task5) . "]<br><br>";

            $keys = array_keys($array_task5);
            $values = array_values($array_task5);
    
            echo "Массив ключей: [" . implode(', ', $keys) . "]<br>";
            echo "Массив значений: [" . implode(', ', $values) . "]<br>";
        ?>
    </section>
</body>

</html>