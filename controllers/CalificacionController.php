<?php

namespace app\controllers;

use Yii;
use app\models\Calificacion;
use yii\web\Controller;

class CalificacionController extends Controller
{
	public function actionCreateCalificacion(){
		$params = Yii::$app->request->queryParams;
		$observaciones = isset($params['observaciones']) ? $params['observaciones'] : null;
		$puntaje = isset($params['puntaje']) ? $params['puntaje'] : null;
		$checkin = isset($params['checkin']) ? $params['checkin'] : null;
		$fecha = date("Y-m-d h:i:sa");
		if($observaciones != null && $puntaje != null && $checkin != null){
			$model = new Calificacion();
			$model->Fecha = $fecha;
			$model->Checkin = $checkin;
			$model->Puntaje = $puntaje;
			$model->Observaciones = $observaciones;
			if($model->save())
				return $model->id;
			else
				return -1;
		}
		return 0;
	}
}