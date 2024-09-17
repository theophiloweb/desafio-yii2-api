<?php

use app\models\User;
use yii\console\Application;

// Configuração do Yii2 para executar o script na linha de comando
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

// Configuração do Yii2
$config = require __DIR__ . '/config/console.php';
(new Application($config));

// Função para criar um usuário com auth_key gerado
function createUserWithAuthKey($username, $password) {
    $user = new User();
    $user->username = $username;
    $user->setPassword($password);
    $user->generateAuthKey(); // Gera o auth_key

    if ($user->save()) {
        echo "Usuário criado com sucesso.\n";
        echo "Auth Key: " . $user->auth_key . "\n";
    } else {
        echo "Erro ao criar usuário:\n";
        print_r($user->errors);
    }
}

// Substitua 'admin' e 'admin' pelos valores desejados
createUserWithAuthKey('admin', 'admin');
