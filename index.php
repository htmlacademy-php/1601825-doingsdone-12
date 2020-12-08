<?php
require_once ('helpers.php');
// показывать или нет выполненные задачи
    $show_complete_tasks = rand(0, 1);
    // Устанавливаем id пользователя
    $userID = 1;

    // Подключаемся к БД
$con = mysqli_connect("localhost", "root", "root","doingsdone");

    // Создаем запросы к таблицам
$sql = "SELECT * FROM projects WHERE user_id=$userID";
$sql2 = "SELECT * FROM tasks WHERE task_autor=(SELECT id FROM users WHERE id=$userID)";
$sql3 = "SELECT user_name FROM users WHERE id = $userID";

// Отправляем запросы к таблицам
$resPr = mysqli_query($con, $sql);
$resTasks = mysqli_query($con, $sql2);
$resUser = mysqli_query($con, $sql3);

// Преобразуем полученные объекты в массивы
$project = mysqli_fetch_all($resPr, MYSQLI_ASSOC);
$taskInfo=mysqli_fetch_all($resTasks, MYSQLI_ASSOC);
$UserName = (mysqli_fetch_all($resUser, MYSQLI_ASSOC))[0]['user_name'];

    //Функция для получения разницы в датах и определения просрочки выполнения задачи. Возвращает true либо false
    function diferDate($date_1, $date_2)
        {
            $diffTime = (new DateTime(date('d.m.Y H:i:s', strtotime($date_1))))->diff((new DateTime(date('d.m.Y H:i:s', strtotime($date_2)))))->format("%r%a");
            // print_r ($diffTime);
            if ($diffTime <= 1) {
                return true;
            } else return false;
        }
//Получаем текущую дату
    $date_1=date('d.m.Y H:i:s');
    $pageContent = include_template('main.php', ['project' => $project, 'taskInfo' => $taskInfo, 'show_complete_tasks' => $show_complete_tasks, 'date_1'=>$date_1]);
    $layoutContent = include_template('layout.php', ['content' => $pageContent, 'title' => "Дела в порядке", 'Uname'=>$UserName]);
    print ($layoutContent);
?>



