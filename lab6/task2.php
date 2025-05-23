<?php
    session_start();

    if (isset($_SESSION['message'])) {
        echo "Вот, что тебе отправили: " . $_SESSION['message'];
    } else {
        echo "Эх, тебе ничего не отправили(";
}
?>