<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аргунов Денис Сергеевич 241-321 Lab2</title>
</head>

<body>
    <h1>3.1. Ссылки и файлы</h1>
    <h2>Выполнил: Аргунов Денис Сергеевич (241-321)</h2>

    <section class="task1">
        <h3>Задание 1 (СДО)</h3>

        <form action="" method="get">
            <label for="text">Введите текст:</label><br>
            <input type="text" id="text" name="text" style="width: 300px;">
            <button type="submit">Отправить</button>
        </form>

        <?php
        function capitalizeEverySecondWord(&$words)
        {
            foreach ($words as $index => $word) {
                if (($index + 1) % 2 == 0) {
                    $words[$index] = mb_strtoupper($word);
                }
            }
        }

        if (isset($_GET['text'])) {
            $inputText = trim($_GET['text']);
            if (!empty($inputText)) {
                $wordsArray = preg_split('/\s+/', $inputText);

                capitalizeEverySecondWord($wordsArray);

                $resultText = implode(' ', $wordsArray);

                echo "<p><strong>Результат:</strong> $resultText</p>";
            } else {
                echo "<p style='color: red;'>Введите текст!</p>";
            }
        }
        ?>

    </section>

    <section class="task2">
        <h3>Задание 2 (СДО)</h3>

        <?php
        $file = 'text.txt';

        $file_open = fopen($file, 'w');

        if ($file_open) {
            fwrite($file_open, '12345');
            fclose($file_open);
            echo "Текст записан!";
        } else {
            echo "Не удалось открыть файл.";
        }
        ?>

    </section>

    <section class="task3">
        <h3>Задание 3 (СДО)</h3>

        <?php
        $files = ['1.txt', '2.txt', '3.txt'];

        $allFiles = '';

        foreach ($files as $file) {
            if (file_exists($file)) {
                $content = file_get_contents($file);
                $allFiles .= $content . ' ';
            } else {
                echo "Файл $file не найден!<br>";
            }
        }

        $allFiles = trim($allFiles);
        $newFile = 'new.txt';

        if (!empty($allFiles)) {
            file_put_contents($newFile, $allFiles);
            echo "Данные успешно записаны в $newFile.<br>";
            echo "Содержимое нового файла:<br>";

            $newContent = file_get_contents($newFile);
            echo "<b><i>\"$newContent\"</b></i><br>";
        } else {
            echo "Нет данных для записи.";
        }
        ?>
    </section>

    <section class="task4">
        <h3>Задание 4 (СДО)</h3>

        <?php
        $filesTask4 = ['1Task4.txt', '2Task4.txt', '3Task4.txt'];

        foreach ($filesTask4 as $fileTask4) {
            if (file_exists($fileTask4)) {
                $originalContent = file_get_contents($fileTask4);
                echo "Оригинальное содержимое $fileTask4: " . htmlspecialchars($originalContent) . "<br>";

                $updatedContent = $originalContent . '!';

                file_put_contents($fileTask4, $updatedContent);

                $newContent = file_get_contents($fileTask4);
                echo "Новое содержимое $fileTask4:> " . htmlspecialchars($newContent) . "<br><br>";
            } else {
                echo "Файл $fileTask4 не найден!<br>";
            }
        }
        ?>
    </section>

    <section class="task5">
        <h3>Задание 5 (СДО)</h3>

        <?php
            $fileTask5 = 'count.txt';

            if (file_exists($fileTask5)) {
                $originalContentTask5 = file_get_contents($fileTask5);
                echo "Оригинальное содержимое $fileTask5: " . htmlspecialchars($originalContentTask5) . "<br>";

                $updatedContentTask5 = (int)$originalContentTask5 + 1;

                file_put_contents($fileTask5, $updatedContentTask5);

                $newContentTask5 = file_get_contents($fileTask5);
                echo "Новое содержимое $fileTask5: " . htmlspecialchars($newContentTask5) . "<br><br>";
            } else {
                echo "Файл $fileTask5 не найден!<br>";
            }
        ?>
    </section>

</body>

</html>