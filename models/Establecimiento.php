<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "establecimiento".
 *
 * @property integer $id
 * @property string $Nombre
 * @property string $Direccion
 * @property string $Telefono
 * @property string $Email
 * @property integer $Ciudad
 * @property string $Icono
 * @property integer $Galeria
 * @property string $Latitud
 * @property string $Longitud
 *
 * @property Admin[] $admins
 * @property Checkin[] $checkins
 * @property CiuEst[] $ciuEsts
 * @property EstProdserv[] $estProdservs
 * @property Galeria[] $galerias
 */
class Establecimiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'establecimiento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre', 'Direccion', 'Telefono', 'Email', 'Ciudad', 'Icono', 'Latitud', 'Longitud'], 'required'],
            [['Ciudad', 'Galeria'], 'integer'],
            [['Nombre', 'Direccion', 'Telefono', 'Email', 'Icono', 'Latitud', 'Longitud'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Nombre' => 'Nombre',
            'Direccion' => 'Direccion',
            'Telefono' => 'Telefono',
            'Email' => 'Email',
            'Ciudad' => 'Ciudad',
            'Icono' => 'Icono',
            'Galeria' => 'Galeria',
            'Latitud' => 'Latitud',
            'Longitud' => 'Longitud',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmins()
    {
        return $this->hasMany(Admin::className(), ['Establecimiento' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckins()
    {
        return $this->hasMany(Checkin::className(), ['Establecimiento' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCiuEsts()
    {
        return $this->hasMany(CiuEst::className(), ['Estab_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstProdservs()
    {
        return $this->hasMany(EstProdserv::className(), ['Est_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalerias()
    {
        return $this->hasMany(Galeria::className(), ['Establecimiento' => 'id']);
    }
}
