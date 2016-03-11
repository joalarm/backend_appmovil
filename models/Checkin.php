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
    
    public function getPuntajeCalificacion(){
    	$calificacion = Calificacion::find()->where(['checkin' => $this->id])->one();
    	if(!isset($calificacion->Puntaje))
    		return null;
    	if($calificacion->Puntaje == 1)
    		return 'Malo';
    	if($calificacion->Puntaje == 2)
    		return 'Regular';
    	if($calificacion->Puntaje == 3)
    		return 'Bueno';
    }
    
    public function getObservacionesCalificacion(){
    	$calificacion = Calificacion::find()->where(['checkin' => $this->id])->one();
    	if(isset($calificacion->Observaciones))
    		return $calificacion->Observaciones;
    	else return null;
    }
    
    public function getEdadCliente(){
    	$cliente = Cliente::findOne($this->Cliente);
    	if(isset($cliente->F_nacimiento)){
    		$datetime1 = new \DateTime($cliente->F_nacimiento);
    		$datetime2 = new \DateTime();
    		$diff = $datetime1->diff($datetime2);
    		return utf8_encode($diff->y." años");
    	} else {
    		return null;
    	}
    }
}
