<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Checkin;


/**
 * BusquedaCheckin represents the model behind the search form about `app\models\Checkin`.
 */
class BusquedaCheckin extends Checkin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Cliente', 'Establecimiento'], 'integer'],
            [['Fecha', 'Longitud', 'Latitud'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Checkin::find()->joinWith('cliente');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'Fecha' => $this->Fecha,
            'Cliente' => $this->Cliente,
            'Establecimiento' => $this->Establecimiento, 
        ]);

        $query->andFilterWhere(['like', 'Longitud', $this->Longitud])
            ->andFilterWhere(['like', 'Latitud', $this->Latitud]);
        
        

        return $dataProvider;
    }
}
