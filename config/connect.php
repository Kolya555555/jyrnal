<?php

/* Делаем константи для хранения данных о базе данных
 * HOST - адрес для подключения к БД
 * USER - логин для доступа к БД
 * PASSWORD - пароль для доступа к БД
 * DATABASE - название базы данных, к которой мы подключаемся */
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', 'hbJJ0090@@');
define('DATABASE', 'miymikolay_db');

/*Подключаемся к базе данных с помощью функции mysqli_connect()*/
$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
mysqli_set_charset($connect,"utf8");


/* Делаем проверку соединения
 * Если есть ошибки, останавливаем код и выводим сообщение с ошибкой */
if (!$connect) {
    die('Error connect to database!!!');
}