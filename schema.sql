CREATE DATABASE IF NOT EXISTS doingsdone DEFAULT CHARACTER SET UTF8 DEFAULT COLLATE UTF8_GENERAL_CI;

USE doingsdone;

-- Создаем таблицу пользователей
CREATE TABLE IF NOT EXISTS users (
id INT AUTO_INCREMENT PRIMARY KEY,
user_name VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
email VARCHAR(50) UNIQUE NOT NULL COLLATE 'utf8_general_ci',
user_reg DATETIME DEFAULT NOW(),
user_pass VARCHAR(32) NOT NULL COLLATE 'utf8_general_ci');

-- Создаем таблицу проектов
CREATE TABLE IF NOT EXISTS projects (
id INT AUTO_INCREMENT PRIMARY KEY,
project_name VARCHAR(200) NOT NULL COLLATE 'utf8_general_ci',
user_id INT(9) NOT NULL,
CONSTRAINT FK_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE RESTRICT ON DELETE RESTRICT);

-- Создаем таблицу задач
CREATE TABLE IF NOT EXISTS tasks (
id INT AUTO_INCREMENT PRIMARY KEY,
task_name VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
task_date_create DATETIME DEFAULT NOW(),
task_date_end DATETIME DEFAULT NOW(),
task_status INT(1) NOT NULL DEFAULT 0,
task_file VARCHAR(255) COLLATE 'utf8_general_ci',
task_autor INT(9) NOT NULL,
task_project INT(9) NOT NULL,
CONSTRAINT FK_taskautor FOREIGN KEY (task_autor) REFERENCES users(id) ON UPDATE RESTRICT ON DELETE RESTRICT,
CONSTRAINT FK_taskproject FOREIGN KEY (task_project) REFERENCES projects(id) ON UPDATE RESTRICT ON DELETE RESTRICT);

-- Создаем индексы к таблицам
CREATE INDEX u_name on users (user_name);
CREATE INDEX pr_name on projects (project_name);
CREATE INDEX t_run on tasks (task_status);
CREATE INDEX t_name ON tasks (task_name);
