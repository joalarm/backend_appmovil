<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calificacion".
 *
 * @property integer $id
 * @property string $Fecha
 * @property integer $Checkin
 * @property string $Observaciones
 * @property integer $Puntaje
 *
 * @property Checkin $checkin
 */
class Calificacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calificacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Fecha', 'Checkin', 'Observaciones', 'Puntaje'], 'required'],
            [['Fecha'], 'safe'],
            [['Checkin', 'Puntaje'], 'integer'],
            [['Observaciones'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Fecha' => 'Fecha',
            'Checkin' => 'Checkin',
            'Observaciones' => 'Observaciones',
            'Puntaje' => 'Puntaje',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckin()
    {
        return $this->hasOne(Checkin::className(), ['id' => 'Checkin']);
    }
}
