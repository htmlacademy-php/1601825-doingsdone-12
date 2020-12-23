<?php
require_once ('helpers.php');
require_once ('db.php');
$con=db_connect ();
$date_1=date('Y-m-d');
// показывать или нет выполненные задачи
    $show_complete_tasks = rand(0, 1);
    // Устанавливаем id пользователя
    $userID = 2;

//Проверяем пришли ли мы на страницу по запросу POST при создании задачи или по кнопке создать задачу
if (!$_POST==NULL) {
    $TaskFormName = htmlspecialchars($_POST['name']) ?? '';
    $TaskFormName = mysqli_real_escape_string($con, $TaskFormName);
    $TaskFormProgect = $_POST['project'] ?? '';
    $TaskFormDate = $_POST['date'] ?? '';
    $fileUrl = InputFile($_FILES['file']);

    if ($TaskFormName!=NULL && $TaskFormProgect!=NULL && !diferDate($date_1, $TaskFormDate)) {
        $sql_ins_task = "INSERT INTO tasks (task_name, task_date_create, task_date_end, task_status, task_file, task_autor, task_project) VALUES ('$TaskFormName', '$date_1', '$TaskFormDate', 0, '$fileUrl', $userID, $TaskFormProgect)";
        $result = mysqli_query($con, $sql_ins_task);
        if (!$result) {
            $errSQL = mysqli_error($con);
            print("Ошибка MySQL: " . $errSQL);
        }
        if ($result) {
	    $last_id = mysqli_insert_id($con);
}
            header ('Location: index.php?success=true');  // перенаправление на нужную страницу
            exit();    // прерываем работу
    }

    $error=array();
    if ($TaskFormName=='') {
        $error['name']='Введите название задачи';
    }
    if ($TaskFormProgect=='') {
        $error['progect']='Выберите проект';
    }
    if ($TaskFormDate=='' || diferDate($date_1, $TaskFormDate)==true) {
        $error['date']='Выберите корректную дату';
    }
}

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

$TaskFiltr = $_GET['type'] ?? '';
$ProjectID = $_GET['taskF'] ?? '';
$SectionAdd = $_GET['add'] ?? '';

if ((! in_array($ProjectID,array_column($project, 'id')))&&($ProjectID!='')){
   header('HTTP/1.1 404 Not Found');
   header('Status: 404 Not Found');
   exit ();
}


    //Функция для получения разницы в датах и определения просрочки выполнения задачи. Возвращает true либо false
        function diferDate($date_1, $date_2)
            {
                $diffTime = (new DateTime(date('d.m.Y H:i:s', strtotime($date_1))))->diff((new DateTime(date('d.m.Y H:i:s', strtotime($date_2)))))->format("%r%a");
                //echo $diffTime;
                if ($diffTime < 0) {
                    return true;
                } else return false;
            }

 //функция возвращает значение из POST['$name'] и передает на страницу
        function getPostVal($name)
            {
              return $_POST[$name] ?? "";
            }

//функция проверяет корректность даты выполнения поставленной задачи или не выбранную дату
        function validateFilled($name)
            {
                if ((empty($_POST[$name])) || (diferDate($date_1, $name)==true)){
                    return "Заполните корректно дату";
                }
         }

//функция проверяет переданные файлы на загрузку, корректность и возвращает путь к файлу для загрузки в БД
        function InputFile($files)
            {
                if (isset($files['name'])) {
                    $file_name = $files['name'];
                    $file_path = __DIR__ . '/uploads/';
                    $file_url = '/uploads/' . $file_name;

                    move_uploaded_file($files['tmp_name'], $file_path . $file_name);
                    return $file_url;
                }
                return NULL;
          }

//Получаем текущую дату
    $date_1=date('d.m.Y H:i:s');
    $pageContent = include_template('add_main.php', ['ProjectID'=>$ProjectID,'TaskFiltr'=>$TaskFiltr, 'project' => $project, 'taskInfo' => $taskInfo, 'show_complete_tasks' => $show_complete_tasks, 'date_1'=>$date_1, 'error_task_form'=>$error]);
    $layoutContent = include_template('layout.php', ['content' => $pageContent, 'title' => "Дела в порядке - Добавление задачи", 'Uname'=>$UserName]);
    print ($layoutContent);


?>
