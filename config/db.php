<?php

use yii\db\Connection;

return [
    'class' => Connection::class,
    'dsn' => 'pgsql:host=application-postgres;port=5432;dbname=appdb',
    'username' => 'admin',
    'password' => '111111',
    'charset' => 'utf8',
];
