<?php
$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = '';
$db['db_name'] = 'cms';

foreach ($db as $key => $value) {
    define($key, $value);
}
$conection = mysqli_connect($db['db_host'], $db['db_user'], $db['db_pass'], $db['db_name']);

if ($conection) {
    echo 'We are contected';
}
?>