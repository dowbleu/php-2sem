<?php
    session_start();

    if (isset($_SESSION['country'])) {
        echo "Ты указал вот такую страну: " . $_SESSION['country'];
    } else {
        echo "Блин, страна не указана(
        <br>
        Зайди сначала на <a href='index.php'>index.php</a>.";
    }
?>