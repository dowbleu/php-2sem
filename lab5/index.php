<?php
require_once 'menu.php';
require_once 'viewer.php';
require_once 'add.php';
require_once 'edit.php';
require_once 'delete.php';

$mysqli = new mysqli('localhost', 'root', '', 'notebook', 3307);

// if ($mysqli->connect_errno) {
//     die('Ошибка подключения: ' . $mysqli->connect_error);
// } else {
//     echo "Подключение успешно!";
// }

$allowed_actions = ['view', 'add', 'edit', 'delete'];
$action = $_GET['action'] ?? 'view';
if (!in_array($action, $allowed_actions)) {
    $action = 'view';
}

$sort_types = ['added', 'lastname', 'birthday'];
$type = $_GET['type'] ?? 'added';
if (!in_array($type, $sort_types)) {
    $type = 'added';
}
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <title>Notebook (Аргунов)</title>
    <style>
        :root {
            --color_a: rgb(1, 5, 17);
            --back_a: rgba(92, 103, 168, 0.541);
        }

        html {
            font-family: sans-serif;
            font-size: 17px;
        }

        body {
            padding: 0;
            margin: 0;
            font-family: sans-serif;
            background-color: rgb(247, 247, 247);
            font-size: 20px;
        }

        *,
        *::after,
        *::before {
            box-sizing: border-box;
        }

        main {
            text-align: center;
        }

        aside {
            background-color: var(--back_a);
            float: top;
        }

        header {
            width: 100%;
            height: 50px;
            background-color: rgba(92, 103, 168, 0.856);
            display: inline-flex;
            justify-content: space-evenly;
            align-items: center;
        }

        a {
            font-family: 'Lemonada', cursive;
            text-decoration: none;
            color: var(--color_a);
        }

        a:hover {
            background-color: var(--back_a);
            opacity: 1;
        }

        .select {
            text-decoration: underline;
            text-decoration-style: double;
        }

        header a {
            background: var(--back_a_a);
            padding: 10px;
            border-radius: 5px;
        }

        header img {
            width: 100px;
        }

        .submenu {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .submenu a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            text-align: center;
        }

        .submenu .select {
            text-decoration: underline;
            text-decoration-style: double;
        }

        .success {
            color: #0f5132;
            background-color: #d1e7dd;
            border-color: #badbcc;
        }

        .error {
            color: red;
            background-color: #d1e7dd;
            border-color: #badbcc;
        }

        .add {
            width: 90%;
            margin: 15px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-inf {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .column {
            margin: auto;
            width: 50%;
        }

        .div-edit {
            width: 200px;
            text-align: left;
            padding-left: 15px;
        }

        .div-edit .currentRow {
            color: var(--color_a);
            background-color: var(--back_a);
            /* padding-left: 15px; */
        }

        input,
        select,
        textarea {
            display: block;
            width: 400px;
            padding: 5px;
            font-size: 17px;
            font-weight: 400;
            line-height: 1.5;
            color: black;
            background-color: #fff;
            border: 1px solid var(--color_a);
            border-radius: 5px;

        }

        label {
            display: inline-block;
            box-sizing: border-box;
            padding: inherit;
        }

        table {
            margin: 0 auto;
            font-size: 15px;
        }

        td {
            background-color: white;
            padding: 5px;
            margin: 500px;
            border-radius: 5px;
            border: groove;
        }

        .form-btn {
            background-color: rgb(92, 103, 168);
            border: none;
            width: auto;
            height: auto;
            padding: 10px 40px;
            color: #fff;
            font-size: 20px;
            border-radius: 5px;
            transition: .3s;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .form-btn:hover {
            cursor: pointer;
            background-color: #0d26b4;
        }

        footer {
            width: 100%;
            height: 50px;
            background-color: rgb(92, 103, 168);
            position: fixed;
            bottom: 0;
            left: 0;
        }

        .main-menu .menu-item,
        .sub-menu .submenu-item {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            color: white;
            background-color: blue;
            margin-right: 5px;
            border-radius: 5px;
            font-family: 'Lemonada', cursive;
        }

        .main-menu .active,
        .sub-menu .active {
            background-color: red;
        }

        .sub-menu {
            margin-top: 10px;
            font-size: 0.9em;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            gap: 5px;
            flex-wrap: wrap;
            font-family: sans-serif;
        }

        .page,
        .arrow {
            display: inline-block;
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f5f5f5;
            text-decoration: none;
            color: #333;
            transition: background 0.2s, transform 0.2s;
        }

        .page:hover,
        .arrow:hover {
            background: #e0e0e0;
            transform: scale(1.05);
        }

        .page.current {
            background: #007bff;
            color: white;
            font-weight: bold;
            pointer-events: none;
        }
    </style>
</head>

<body>
    <div class="main-menu">
        <?php
        echo getMenu($action, $type);
        ?>
    </div>

    <div>
        <?php
        switch ($action) {
            case 'view':
                echo getFriendsList($mysqli, $type, $page);
                break;
            case 'add':
                echo handleAdd($mysqli);
                break;
            case 'edit':
                echo editRecord($mysqli);
                break;
            case 'delete':
                echo deleteRecord($mysqli);
                break;
            default:
                echo getFriendsList($mysqli, $type, $page);
        }
        ?>
    </div>

</body>

</html>