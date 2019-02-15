<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%carrier}}`.
 */
class m190212_215902_create_carrier_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%carrier}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string('64')->notNull()
        ]);

        $this->createIndex('I_carrier_name', '{{%carrier}}', 'name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('I_carrier_name', '{{%carrier}}');

        $this->dropTable('{{%carrier}}');
    }
}
