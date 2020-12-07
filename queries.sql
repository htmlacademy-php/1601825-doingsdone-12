-- Создаем запрос на внесение данных в таблицу пользователей
INSERT users(user_name, email, user_pass) VALUES
('Сергей Иванович', 'it@donlib.ru', '1234567890'),
('Виктор Иванович', 'info@donlib.ru', '2345678901'),
('Виктор Сергеевич', 'opac@donlib.ru', '2345678901');


-- Создаем запрос на внесение данных в таблицу проектов
INSERT projects(project_name, user_id) VALUES
('Входящие', '1'),
('Учеба', '2'),
('Работа', '3'),
('Домашние дела', '2'),
('Авто', '1');

-- Создаем запрос на внесение данных в таблицу задач
INSERT tasks(task_name, task_date_create, task_date_end, task_status, task_file, task_autor, task_project) VALUES
('Собеседование в IT компании', '2019-11-20 17:28:09', '2019-12-01 17:28:09', 0, NULL, (SELECT user_id FROM projects WHERE project_name='Работа'), (SELECT id FROM projects WHERE project_name='Работа')),
('Выполнить тестовое задание', '2019-11-20 17:28:09', '2019-12-25 17:10:09', 0, NULL, (SELECT user_id FROM projects WHERE project_name='Учеба'), (SELECT id FROM projects WHERE project_name='Учеба')),
('Сделать задание первого раздела', '2019-11-20 17:28:09', '2019-12-25 17:10:09', 1, NULL, (SELECT user_id FROM projects WHERE project_name='Учеба'), (SELECT id FROM projects WHERE project_name='Учеба')),
('Встреча с другом', '2019-11-28 17:28:09', '2019-12-22 17:10:09', 0, NULL, (SELECT user_id FROM projects WHERE project_name='Домашние дела'), (SELECT id FROM projects WHERE project_name='Домашние дела')),
('Замена колес', '2019-11-28 17:28:09', '2019-12-01 17:10:09', 0, NULL, (SELECT user_id FROM projects WHERE project_name='Авто'), (SELECT id FROM projects WHERE project_name='Авто'));

-- Создаем запрос на внесение данных в таблицу задач при условии, что дату окончания не указали
INSERT tasks(task_name, task_date_create, task_status, task_file, task_autor, task_project) VALUES
('Купить корм для кота', '2019-11-28 17:28:09',0, NULL, (SELECT user_id FROM projects WHERE project_name='Домашние дела'), (SELECT id FROM projects WHERE project_name='Домашние дела')),
('Заказать пиццу', '2019-11-28 17:28:09',0, NULL, (SELECT user_id FROM projects WHERE project_name='Домашние дела'), (SELECT id FROM projects WHERE project_name='Домашние дела'));

-- получить список из всех проектов для одного пользователя
SELECT project_name FROM projects WHERE user_id=2;

-- получить список из всех задач для одного проекта
SELECT task_name FROM tasks WHERE task_project=(SELECT id FROM projects WHERE project_name='Работа');

-- получить список из всех задач для одного пользователя
SELECT task_name FROM tasks WHERE task_autor=(SELECT id FROM users WHERE user_name='Виктор Иванович');

-- пометить задачу как выполненную с передачей параметров
UPDATE tasks JOIN users ON users.id = tasks.task_autor AND users.user_name='Виктор Иванович' AND tasks.task_name='Сделать задание первого раздела' SET tasks.task_status = 1;

-- Обновить задачу по ее идентификатору (id=10)
UPDATE tasks SET task_name= 'Сделать задание третьего раздела' WHERE id=10;
