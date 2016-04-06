<?php

namespace app\controllers;

use Yii;
use app\models\Cliente;
use yii\web\Controller;

class ClienteController extends Controller
{
	public function actionSearchCliente(){
		$params = Yii::$app->request->queryParams;
		if(isset($params['email']) && (($model = Cliente::find()->where(['Email' => $params['email']])->one()) != null))
			return $model->id;
		else
			return -1;
	}
	
	public function actionSearchClienteId(){
		$params = Yii::$app->request->queryParams;
		if(isset($params['id'])){
			$model = Cliente::findOne($params['id']);
			return \yii\helpers\Json::encode($model);
		}
		return -1;
	}
	
	public function actionCreateCliente(){
		$params = Yii::$app->request->queryParams;
		$email = isset($params['email']) ? $params['email'] : null;
		$genero = isset($params['genero']) ? $params['genero'] : null;
		$f_nac = isset($params['f_nac']) ? $params['f_nac'] : null;
		if($email != null){
			if(Cliente::find()->where(['Email' => $email])->one() == null){
				$model = new Cliente();
				$model->Email = $email;
				$model->Genero = $genero;
				$model->F_nacimiento = $f_nac;
				if($model->save())
					return $model->id;
				else
					return -1;
			} else {
				return 0;
			}
		}		
		return -1;
	}
}