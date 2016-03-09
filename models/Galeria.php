<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "galeria".
 *
 * @property integer $id
 * @property string $Titulo
 * @property integer $Establecimiento
 *
 * @property Establecimiento $establecimiento
 * @property Imagen[] $imagens
 */
class Galeria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'galeria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Titulo', 'Establecimiento'], 'required'],
            [['Establecimiento'], 'integer'],
            [['Titulo'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Titulo' => 'Titulo',
            'Establecimiento' => 'Establecimiento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstablecimiento()
    {
        return $this->hasOne(Establecimiento::className(), ['id' => 'Establecimiento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagens()
    {
        return $this->hasMany(Imagen::className(), ['Galeria' => 'id']);
    }
}
