<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cliente}}`.
 */
class m240918_103000_create_cliente_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cliente}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(255)->notNull(),
            'cpf' => $this->string(11)->notNull()->unique(),
            'cep' => $this->string(8)->notNull(),
            'logradouro' => $this->string(255)->notNull(),
            'numero' => $this->string(10)->notNull(),
            'cidade' => $this->string(255)->notNull(),
            'estado' => $this->string(2)->notNull(),
            'complemento' => $this->string(255)->null(),
            'sexo' => $this->char(1)->notNull()->check("sexo IN ('M', 'F')"),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cliente}}');
    }
}
