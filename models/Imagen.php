<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imagen".
 *
 * @property integer $id
 * @property string $Titulo
 * @property integer $Galeria
 * @property string $Ruta
 *
 * @property Galeria $galeria
 */
class Imagen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imagen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Titulo', 'Galeria', 'Ruta'], 'required'],
            [['Galeria'], 'integer'],
            [['Titulo'], 'string', 'max' => 45],
        	[['Ruta'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']
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
            'Galeria' => 'Galeria',
            'Ruta' => 'Ruta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGaleria()
    {
        return $this->hasOne(Galeria::className(), ['id' => 'Galeria']);
    }
    
    public function scenarios(){
    	$scenarios = parent::scenarios();
    	$scenarios['actualizar'] = ['Titulo'];//Scenario Values Only Accepted
    	return $scenarios;
    }
    
    
    public function upload()
    {
    	if ($this->validate()) {
    		if(isset($this->Ruta) && ($this->Ruta != null))
    			$this->Ruta->saveAs('img/galerias/' . $this->Ruta->baseName . '.' . $this->Ruta->extension);
    		return true;   			
    	} else {
    		return false;
    	}
    }
    
    public function getGaleriaNombre(){
    	$galeria = Galeria::findOne($this->Galeria);
    	return $galeria->Titulo;
    }
}
