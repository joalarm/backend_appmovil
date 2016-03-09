<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "checkin".
 *
 * @property integer $id
 * @property string $Fecha
 * @property string $Longitud
 * @property string $Latitud
 * @property integer $Cliente
 * @property integer $Establecimiento
 *
 * @property Calificacion[] $calificacions
 * @property Cliente $cliente
 * @property Establecimiento $establecimiento
 */
class Checkin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Fecha', 'Cliente', 'Establecimiento'], 'required'],
            [['Fecha'], 'safe'],
            [['Cliente', 'Establecimiento'], 'integer'],
            [['Longitud', 'Latitud'], 'string', 'max' => 45]
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
            'Longitud' => 'Longitud',
            'Latitud' => 'Latitud',
            'Cliente' => 'Cliente',
            'Establecimiento' => 'Establecimiento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalificacions()
    {
        return $this->hasMany(Calificacion::className(), ['Checkin' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['id' => 'Cliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstablecimiento()
    {
        return $this->hasOne(Establecimiento::className(), ['id' => 'Establecimiento']);
    }
}
