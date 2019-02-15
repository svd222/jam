<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "station".
 *
 * @property int $id
 * @property string $name
 */
class Station extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%station}}';
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
            'id' => Yii::t('station', 'ID'),
            'name' => Yii::t('station', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArrivalSchedules()
    {
        return $this->hasMany(Schedule::className(), ['arrival_station_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartureSchedules()
    {
        return $this->hasMany(Schedule::className(), ['departure_station_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return StationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StationQuery(get_called_class());
    }
}
