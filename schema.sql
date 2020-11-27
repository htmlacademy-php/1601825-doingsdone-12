CREATE DATABASE IF NOT EXISTS doingsdone DEFAULT CHARACTER SET UTF8 DEFAULT COLLATE UTF8_GENERAL_CI;

USE doingsdone;

CREATE TABLE IF NOT EXISTS users (
id INT AUTO_INCREMENT PRIMARY KEY,
name_user VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
email VARCHAR(50) UNIQUE NOT NULL COLLATE 'utf8_general_ci',
dt_reg_user DATE,
user_pass VARCHAR(32) NOT NULL COLLATE 'utf8_general_ci');

CREATE TABLE IF NOT EXISTS tasks (
id INT AUTO_INCREMENT PRIMARY KEY,
name_task VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
dt_create DATE NOT NULL,
dt_end DATE NOT NULL,
task_stat INT(1) NOT NULL DEFAULT 0,
task_file VARCHAR(255) COLLATE 'utf8_general_ci',
task_autor INT(9) NOT NULL,
task_project INT(9) NOT NULL);

CREATE TABLE IF NOT EXISTS projects (
id_pr INT AUTO_INCREMENT PRIMARY KEY,
name_pr VARCHAR(200) NOT NULL COLLATE 'utf8_general_ci',
id_user INT(9) NOT NULL);

CREATE INDEX n_user on users (name_user);
CREATE INDEX n_pr on projects (name_pr);
CREATE INDEX t_stat on tasks (task_stat);
CREATE INDEX n_task ON tasks (name_task);
