<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_prodserv".
 *
 * @property integer $id
 * @property integer $Cat_id
 * @property integer $ProdServ_id
 *
 * @property Categoria $cat
 * @property ProductoServicio $prodServ
 */
class CatProdserv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cat_prodserv';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Cat_id', 'ProdServ_id'], 'required'],
            [['Cat_id', 'ProdServ_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Cat_id' => 'Cat ID',
            'ProdServ_id' => 'Prod Serv ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'Cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdServ()
    {
        return $this->hasOne(ProductoServicio::className(), ['id' => 'ProdServ_id']);
    }
}
