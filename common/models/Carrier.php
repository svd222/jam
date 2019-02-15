<?php

namespace common\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "{{%carrier}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property Schedule[] $schedules
 */
class Carrier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%carrier}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'length' => [5, 63]],
            [['name'], 'correctFirstSymbol']
        ];
    }

    public function correctFirstSymbol($attribute, $params, $validator)
    {
        if (!preg_match('/[a-zA-z0-9_]/mis', mb_substr($this->name, 0, 1))) {
            $this->addError('name', 'First symbol should be _, digit or english character');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('carrier', 'ID'),
            'name' => Yii::t('carrier', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['carrier_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CarrierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CarrierQuery(get_called_class());
    }
}
