<?php
require_once ('helpers.php');
// показывать или нет выполненные задачи
    $show_complete_tasks = rand(0, 1);
    $project = ['Входящие', 'Учеба', 'Работа', 'Домашние дела', 'Авто'];
    $taskInfo = [
        [
            'task_name'=>'Собеседование в IT компании',
            'task_date'=>'01.12.2019',
            'task_type'=>'Работа',
            'task_full'=>false],
        [
            'task_name'=>'Выполнить тестовое задание',
            'task_date'=>'25.12.2019',
            'task_type'=>'Работа',
            'task_full'=>false],
        [
            'task_name'=>'Сделать задание первого раздела',
            'task_date'=>'25.12.2019',
            'task_type'=>'Учеба',
            'task_full'=>true],
        [
            'task_name'=>'Встреча с другом',
            'task_date'=>'22.12.2019',
            'task_type'=>'Входящие',
            'task_full'=>false],
        [
            'task_name'=>'Купить корм для кота',
            'task_date'=>null,
            'task_type'=>'Домашние дела',
            'task_full'=>false],
        [
            'task_name'=>'Заказать пиццу',
            'task_date'=>null,
            'task_type'=>'Домашние дела',
            'task_full'=>false],
        [
            'task_name'=>'Замена колес',
            'task_date'=>'01.12.2019',
            'task_type'=>'Авто',
            'task_full'=>false]
    ];

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
    $layoutContent = include_template('layout.php', ['content' => $pageContent, 'title' => "Дела в порядке", 'user_name'=>'Алексей']);
    print ($layoutContent);
?>



