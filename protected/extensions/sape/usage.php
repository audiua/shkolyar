<?php
/*
 * Пример использования класса SapeClientEasy (в консоли)
 */

require('Sape.php');
//создаем объект, в который передаем данные для авторизации и полный путь к временному файлу для cookies
$sape = new SapeClientEasy('ВашЛогин', 'ВашПароль', '/var/www/sapeClient/cookie.txt');
//получаем баланс и выводим пользователю
echo "\r\n Баланс в системе sape.ru: {$sape->balance()}  RUB\r\n";