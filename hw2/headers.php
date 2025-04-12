<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Результат get_headers</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        header {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: repeat(1, 1fr);
            align-items: center;
        }

        img {
            width: 50%;
        }

        .heading {
            grid-column: 2 / 4;
        }
    </style>
</head>

<body>
    <header>
        <img src="./Logo_Polytech_rus_main.jpg" alt="Логотип МосПолитеха">
        <h1 class="heading">Результат работы get_headers</h1>
    </header>

    <main>
        <textarea readonly id="headersOutput" rows="20" cols="80">
            <?php
            // Получаем заголовки текущего запроса
            $headers = getallheaders(); // альтернатива get_headers для входящих запросов

            foreach ($headers as $key => $value) {
                echo "$key: $value\n";
            }
            ?>
        </textarea>
    </main>

    <footer>
        Задание для самостоятельной работы
    </footer>
</body>

</html>