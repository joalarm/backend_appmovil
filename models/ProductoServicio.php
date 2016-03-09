<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "producto_servicio".
 *
 * @property integer $id
 * @property string $Nombre
 * @property string $Descripcion
 * @property string $Precio
 * @property file $Imagen
 * @property integer $Es_producto
 *
 * @property CatProdserv[] $catProdservs
 * @property EstProdserv[] $estProdservs
 */
class ProductoServicio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto_servicio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nombre', 'Es_producto'], 'required'],
            [['Es_producto'], 'integer'],
            [['Nombre', 'Descripcion', 'Precio'], 'string', 'max' => 45],
        	[['Imagen'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg']
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
            'Descripcion' => 'Descripcion',
            'Precio' => 'Precio',
            'Imagen' => 'Imagen',
            'Es_producto' => 'Es Producto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatProdservs()
    {
        return $this->hasMany(CatProdserv::className(), ['ProdServ_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstProdservs()
    {
        return $this->hasMany(EstProdserv::className(), ['Prodserv_id' => 'id']);
    }
    
    public function upload()
    {
    	if ($this->validate()) {
    		if(isset($this->Imagen) && ($this->Imagen != null))
    			$this->Imagen->saveAs('img/imgprodserv/' . $this->Imagen->baseName . '.' . $this->Imagen->extension);
    		return true;
    	} else {
    		return false;
    	}
    }
    
    public function getTipoNombre(){
    	if($this->Es_producto == 1)
    		return 'Producto';
    	else
    		return 'Servicio';
    }
    
    public function getCategoria(){
    	$cat_prodserv = CatProdserv::find()->where(['Prodserv_Id' => $this->id])->one();
    	$categoria = Categoria::findOne($cat_prodserv->Cat_id);
    	return $categoria->Nombre;
    }
}
