<?php
function getFriendsList(mysqli $mysqli, string $type, int $page): string
{
    $limit = 10;
    $offset = ($page - 1) * $limit;

    switch ($type) {
        case 'lastname':
            $orderBy = 'LOWER(lastname) DESC';
            break;
        case 'date':
            $orderBy = 'birthday DESC';
            break;
        case 'added':
        default:
            $orderBy = 'id ASC';
            break;
    }

    // счет общего количество записей в таблице
    $resultCount = $mysqli->query("SELECT COUNT(*) AS total FROM contacts");
    $rowCount = $resultCount->fetch_assoc(); // берёт результат запроса как ассоциативный массив.
    $total = $rowCount['total'];

    // счет количества страниц
    $pagesCount = ceil($total / $limit);

    // записи текущей страницы
    $sql = "SELECT * FROM contacts ORDER BY $orderBy LIMIT $limit OFFSET $offset";
    $result = $mysqli->query($sql);

    // формирование таблицы HTML
    $html = '<h2>Список контактов</h2>';
    $html .= '<table border="1" cellpadding="5" cellspacing="0">';
    $html .= '<tr>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Дата рождения</th>
                <th>Телефон</th>
                <th>Адрес</th>
                <th>E-mail</th>
                <th>Комментарий</th>
                <th>Действия</th>
              </tr>';

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($row['surname']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['lastname']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['date']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['phone']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['location']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['email']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['comment']) . '</td>';
            $html .= '<td><a href="index.php?action=edit&id=' . $row['id'] . '">Редактировать</a> | <a href="index.php?action=delete&id=' . $row['id'] . '">Удалить</a></td>';
            $html .= '</tr>';
        }
    } else {
        $html .= '<tr><td colspan="9">Записей не найдено</td></tr>';
    }
    $html .= '</table>';

    // пагинация
    if ($pagesCount > 1) {
        $html .= '<div class="pagination">';

        // назад
        if ($page > 1) {
            $prevPage = $page - 1;
            $html .= "<a href=\"index.php?action=view&type=$type&page=$prevPage\" class=\"arrow\">&laquo;</a>";
        }

        // номера страниц
        for ($i = 1; $i <= $pagesCount; $i++) {
            if ($i == $page) {
                $html .= "<span class=\"page current\">$i</span>";
            } else {
                $html .= "<a href=\"index.php?action=view&type=$type&page=$i\" class=\"page\">$i</a>";
            }
        }

        // вперёд
        if ($page < $pagesCount) {
            $nextPage = $page + 1;
            $html .= "<a href=\"index.php?action=view&type=$type&page=$nextPage\" class=\"arrow\">&raquo;</a>";
        }

        $html .= '</div>';
    }

    return $html;
}
