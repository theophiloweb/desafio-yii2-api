<?php

namespace app\commands;

use yii\console\Controller;
use Firebase\JWT\JWT;
use yii\helpers\Console;

class TokenController extends Controller
{
    // Defina uma chave secreta para o JWT (mantenha essa chave segura)
    private $jwtSecret = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IlRlb3BoaWxvIiwiaWF0IjoxNTE2MjM5MDIyfQ.ydLFWOREZrN_XINaIFeXMPZ8OC2atgu9zssHDyyaruM';

    // Comando que gera o token JWT
    public function actionCreate($userId)
    {
        $payload = [
            'iss' => 'localhost', // Emissor do token (pode ser sua aplicação)
            'aud' => 'localhost', // Destinatário do token
            'iat' => time(), // Hora da emissão
            'exp' => time() + 3600, // Expiração (1 hora)
            'data' => [
                'userId' => $userId, // Informações do usuário (payload)
            ]
        ];

        // Gerar o token usando a chave secreta
        $jwt = JWT::encode($payload, $this->jwtSecret, 'HS256');

        // Exibir o token no terminal
        Console::output("Token JWT gerado: " . $jwt);
    }

    // Método para decodificar e verificar o token JWT
    public function actionVerify($token)
    {
        try {
            $decoded = JWT::decode($token, $this->jwtSecret, ['HS256']);
            Console::output("Token válido. Informações do token:");
            print_r($decoded);
        } catch (\Exception $e) {
            Console::output("Token inválido: " . $e->getMessage());
        }
   
