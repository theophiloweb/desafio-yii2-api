<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Cliente extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%cliente}}';
    }

    public function rules()
    {
        return [
            [['nome', 'cpf', 'cep', 'logradouro', 'numero', 'cidade', 'estado', 'sexo'], 'required'],
            [['nome', 'logradouro', 'cidade'], 'string', 'max' => 255],
            ['cpf', 'string', 'max' => 11],
            ['cpf', 'unique'],
            ['cep', 'string', 'max' => 8],
            ['numero', 'string', 'max' => 10],
            ['estado', 'string', 'max' => 2],
            ['complemento', 'string', 'max' => 255],
            ['sexo', 'in', 'range' => ['M', 'F']],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cpf' => 'CPF',
            'cep' => 'CEP',
            'logradouro' => 'Logradouro',
            'numero' => 'Número',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'complemento' => 'Complemento',
            'sexo' => 'Sexo',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
        ];
    }
}