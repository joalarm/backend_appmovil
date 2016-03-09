<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $Email
 * @property string $Contrasena
 * @property integer $Establecimiento
 * @property integer $Superadmin
 * @property string $authKey
 * @property string $accessToken
 *
 * @property Establecimiento $establecimiento
 */
class Admin extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Email', 'Contrasena', 'Superadmin'], 'required'],
            [['Establecimiento'], 'integer'],
			[['Superadmin'],'boolean'],
            [['Email', 'Contrasena', 'authKey', 'accessToken'], 'string', 'max' => 45],
			['Email', 'email']
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
            'Establecimiento' => 'Establecimiento',
            'Superadmin' => 'Superadmin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstablecimiento()
    {
        return $this->hasOne(Establecimiento::className(), ['id' => 'Establecimiento']);
    }
    
    public function getEstablecimientoNombre()
    {
    	$establecimiento = Establecimiento::findOne($this->Establecimiento);
    	return $establecimiento->Nombre;
    }
    
    /**
     * Devuelve el tipo de administrador
     *
     * @param  null
     * @return String
     */
    public function getSuperAdminNombre()
    {
    	if($this->Superadmin == 1)
    		return 'Si';
    	else
    		return 'No';
    }
    
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($email) {
    	$dbUser = Admin::find()
    	->where([
    			"Email" => $email
    	])
    	->one();
    	if (!count($dbUser)) {
    		return null;
    	}
    	return new static($dbUser);
    }
    
    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
    	return $this->Contrasena === $password;
    }
    
    public static function findIdentity($id)
    {
    	return static::findOne($id);
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
    	return static::findOne(['access_token' => $token]);
    }
    
    public function getId()
    {
    	return $this->id;
    }
    
    public function getAuthKey()
    {
    	return $this->authKey;
    }
    
    public function validateAuthKey($authKey)
    {
    	return $this->authKey === $authKey;
    }
}
