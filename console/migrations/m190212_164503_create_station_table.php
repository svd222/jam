<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%station}}`.
 */
class m190212_164503_create_station_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%station}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull()
        ]);

        $this->createIndex('I_station_name', '{{%station}}', 'name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('I_station_name', '{{%station}}');

        $this->dropTable('{{%station}}');
    }
}
