<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%schedule}}`.
 */
class m190212_215918_create_schedule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%schedule}}', [
            'id' => $this->primaryKey(),
            'departure_station_id' => $this->integer()->notNull(),
            'departure_time' => $this->integer()->notNull(),
            'arrival_station_id' => $this->integer()->notNull(),
            'arrival_time' => $this->integer()->notNull(),
            'cost' => $this->double()->notNull(),
            'carrier_id' => $this->integer()->notNull(),
            'schedule_by_day_of_week' => $this->smallInteger()->notNull()->comment('calculated as a bitwise sum (and) of the days of the week (from 1 to 7)')
        ]);

        $this->addForeignKey('FK_schedule_departure_station', '{{%schedule}}', 'departure_station_id', '{{%station}}', 'id', 'RESTRICT');
        $this->addForeignKey('FK_schedule_arrival_station', '{{%schedule}}', 'arrival_station_id', '{{%station}}', 'id', 'RESTRICT');
        $this->addForeignKey('FK_schedule_carrier', '{{%schedule}}', 'carrier_id', '{{%carrier}}', 'id', 'RESTRICT');

        $this->createIndex('I_schedule_cost', '{{%schedule}}', 'cost');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('I_schedule_cost', '{{%schedule}}');

        $this->dropForeignKey('FK_schedule_carrier', '{{%schedule}}');
        $this->dropForeignKey('FK_schedule_arrival_station', '{{%schedule}}');
        $this->dropForeignKey('FK_schedule_departure_station', '{{%schedule}}');

        $this->dropTable('{{%schedule}}');
    }
}
