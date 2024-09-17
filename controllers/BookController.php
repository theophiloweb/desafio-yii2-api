<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Book;
use app\filters\BearerAuth;

class BookController extends ActiveController
{
    public $modelClass = 'app\models\Book';

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
        $query = Book::find();

        // Apply filters
        if (isset($requestParams['title'])) {
            $query->andWhere(['like', 'title', $requestParams['title']]);
        }
        if (isset($requestParams['author'])) {
            $query->andWhere(['like', 'author', $requestParams['author']]);
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
        $model = new Book();
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
