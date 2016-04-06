<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $id
 * @property string $Email
 * @property string $Contrasena
 * @property string $Genero
 * @property string $F_nacimiento
 *
 * @property Checkin[] $checkins
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Email'], 'required'],
            [['Email', 'F_nacimiento'], 'string', 'max' => 45],
            [['Contrasena'], 'string', 'max' => 12],
            [['Genero'], 'string', 'max' => 10],
        	[['Email'], 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Email' => 'Email',
            'Contrasena' => 'Contrasena',
            'Genero' => 'Genero',
            'F_nacimiento' => 'F Nacimiento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckins()
    {
        return $this->hasMany(Checkin::className(), ['Cliente' => 'id']);
    }
}
