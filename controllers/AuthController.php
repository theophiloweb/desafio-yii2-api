<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\User;
use yii\web\UnauthorizedHttpException;

class AuthController extends Controller
{
    public function actionLogin()
    {
        Yii::info('Raw input: ' . file_get_contents('php://input'), 'login');
        Yii::info('POST data: ' . json_encode(Yii::$app->request->post()), 'login');

        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        Yii::info('Username: ' . $username, 'login');
        Yii::info('Password: ' . $password, 'login');

        $user = User::findByUsername($username);

        if (!$user || !$user->validatePassword($password)) {
            throw new UnauthorizedHttpException('Invalid username or password');
        }

        $user->generateAuthKey();
        $user->save();

        return [
            'token' => $user->auth_key,
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
            ],
        ];
    }

        public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['except'] = ['login'];
        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::class,
            'actions' => [
                'login' => ['post'],
            ],
        ];
        return $behaviors;
    }
}