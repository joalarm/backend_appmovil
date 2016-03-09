<?php

namespace app\models;

use Yii;
use \yii\db\Query;

/**
 * This is the model class for table "est_prodserv".
 *
 * @property integer $id
 * @property integer $Est_id
 * @property integer $Prodserv_id
 *
 * @property Establecimiento $est
 * @property ProductoServicio $prodserv
 */
class EstProdserv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'est_prodserv';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Est_id', 'Prodserv_id'], 'required'],
            [['Est_id', 'Prodserv_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Est_id' => 'Est ID',
            'Prodserv_id' => 'Prodserv ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEst()
    {
        return $this->hasOne(Establecimiento::className(), ['id' => 'Est_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdserv()
    {
        return $this->hasOne(ProductoServicio::className(), ['id' => 'Prodserv_id']);
    }    
    
    public function getEstablecimiento($id)
    {
    	$result = EstProdserv::find()->where(['Prodserv_id'=>$id])->one();
    	return $result->Est_id;
    }
    
}
