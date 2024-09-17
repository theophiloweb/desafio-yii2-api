<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Book extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%book}}';
    }

    public function rules()
    {
        return [
            [['isbn', 'title', 'author', 'price', 'stock'], 'required'],
            ['isbn', 'string', 'max' => 13],
            ['isbn', 'unique'],
            [['title', 'author'], 'string', 'max' => 255],
            ['price', 'number'],
            ['stock', 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'isbn' => 'ISBN',
            'title' => 'Título',
            'author' => 'Autor',
            'price' => 'Preço',
            'stock' => 'Estoque',
        ];
    }
}