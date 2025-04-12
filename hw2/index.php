<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аргунов Денис Сергеевич 241-321 Домашняя работа №2</title>
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
        <img src="./Logo_Polytech_rus_main.jpg" alt="Картинка">
        <h1 class="heading">4.1. Домашняя работа: Feedback Form</h1>
    </header>

    <main>
        <form action="https://httpbin.org/post" method="POST" target="_blank">
            <label>Имя пользователя:<br>
                <input type="text" name="username" required>
            </label><br>

            <label>E-mail:<br>
                <input type="email" name="email" required>
            </label><br>

            <label>Тип обращения:<br>
                <select name="type">
                    <option>Жалоба</option>
                    <option>Предложение</option>
                    <option>Благодарность</option>
                </select>
            </label><br>

            <label>Текст обращения:<br>
                <textarea name="message" required></textarea>
            </label><br>

            <label>
                <input type="checkbox" name="reply_sms"> Ответ по СМС
            </label><br>
            <label>
                <input type="checkbox" name="reply_email"> Ответ по E-mail
            </label><br><br>

            <button type="submit">Отправить</button>
        </form>

        <a href="headers.php">Перейти на 2 страницу</a>
    </main>

    <footer>
        <p>Аргунов Денис Сергеевич 241-321 Дз2</p>
    </footer>
</body>

</html>