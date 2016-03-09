<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Establecimiento;

/**
 * BusquedaEstablecimiento represents the model behind the search form about `app\models\Establecimiento`.
 */
class BusquedaEstablecimiento extends Establecimiento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Ciudad', 'Galeria'], 'integer'],
            [['Nombre', 'Direccion', 'Telefono', 'Email', 'Icono', 'Latitud', 'Longitud'], 'safe'],
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
        $query = Establecimiento::find();

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
            'Ciudad' => $this->Ciudad,
            'Galeria' => $this->Galeria,
        ]);

        $query->andFilterWhere(['like', 'Nombre', $this->Nombre])
            ->andFilterWhere(['like', 'Direccion', $this->Direccion])
            ->andFilterWhere(['like', 'Telefono', $this->Telefono])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'Icono', $this->Icono])
            ->andFilterWhere(['like', 'Latitud', $this->Latitud])
            ->andFilterWhere(['like', 'Longitud', $this->Longitud]);

        return $dataProvider;
    }
}
