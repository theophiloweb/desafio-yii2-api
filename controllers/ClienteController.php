<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Cliente;
use app\filters\BearerAuth;

class ClienteController extends ActiveController
{
    public $modelClass = 'app\models\Cliente';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => BearerAuth::class,
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        
        // Customize the index action
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        
        return $actions;
    }

    public function prepareDataProvider()
    {
        $requestParams = Yii::$app->request->queryParams;

        // Prepare the query
        $query = Cliente::find();

        // Apply filters
        if (isset($requestParams['nome'])) {
            $query->andWhere(['like', 'nome', $requestParams['nome']]);
        }
        if (isset($requestParams['cpf'])) {
            $query->andWhere(['cpf' => $requestParams['cpf']]);
        }

        // Apply sorting
        if (isset($requestParams['sort'])) {
            $query->orderBy($requestParams['sort']);
        }

        // Create data provider
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $requestParams['limit'] ?? 20,
                'page' => $requestParams['offset'] ?? 0,
            ],
        ]);

        return $dataProvider;
    }

    public function actionCreate()
    {
        $model = new Cliente();
        $model->load(Yii::$app->request->post(), '');

        if ($model->save()) {
            Yii::$app->response->setStatusCode(201);
            return $model;
        } else {
            Yii::$app->response->setStatusCode(422);
            return $model->errors;
        }
    }
}
