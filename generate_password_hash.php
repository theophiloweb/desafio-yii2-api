<?php

// Carrega o autoloader do Yii e o arquivo de configuração
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

// Inicializa a aplicação console do Yii
$config = require __DIR__ . '/config/console.php';
(new yii\console\Application($config));

// Cria o hash para a senha 'admin'
$password = 'admin';
$hash = Yii::$app->getSecurity()->generatePasswordHash($password);

echo "Password hash: " . $hash . "\n";
