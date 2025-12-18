<?php
if(isset($_SESSION["IdSession"])) {
    $DateNow = date("Y-m-d H:i:s");
    $IdSession = $_SESSION["IdSession"];
    echo "Обновляю сессию ID: $IdSession, время: $DateNow<br>";
    $Sql = "UPDATE `Session` SET `DateNow`='{$DateNow}' WHERE `Id`= {$IdSession}";
    if ($mysqli->query($Sql)) {
        echo "Время успешно обновлено!<br>";
    } else {
        echo "Ошибка обновления: " . $mysqli->error . "<br>";
    }
} else {
    echo "Сессия не установлена!<br>";
}

?>