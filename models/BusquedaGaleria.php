<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Galeria;

/**
 * BusquedaGaleria represents the model behind the search form about `app\models\Galeria`.
 */
class BusquedaGaleria extends Galeria
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Establecimiento'], 'integer'],
            [['Titulo'], 'safe'],
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
    public function search($params, $establecimiento)
    {
        $query = Galeria::find()
        	->where(['Establecimiento' => $establecimiento]);

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
            'Establecimiento' => $this->Establecimiento,
        ]);

        $query->andFilterWhere(['like', 'Titulo', $this->Titulo]);

        return $dataProvider;
    }
}
