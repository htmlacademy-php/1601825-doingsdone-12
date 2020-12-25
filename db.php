<?php
// Подключаемся к БД
function db_connect ()
{
    $con = mysqli_connect("localhost", "root", "root", "doingsdone");
    if ($con == false) {
        print("Ошибка подключения: " . mysqli_connect_error());
    } else {
        // print("Соединение установлено");
        return $con;
    }
}
?>
