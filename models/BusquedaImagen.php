<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Imagen;

/**
 * BusquedaImagen represents the model behind the search form about `app\models\Imagen`.
 */
class BusquedaImagen extends Imagen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Galeria'], 'integer'],
            [['Titulo', 'Ruta'], 'safe'],
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
    public function search($params, $galeria)
    {
        $query = Imagen::find()
        	->where(["Galeria" => $galeria]);

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
            'Galeria' => $this->Galeria,
        ]);

        $query->andFilterWhere(['like', 'Titulo', $this->Titulo])
            ->andFilterWhere(['like', 'Ruta', $this->Ruta]);

        return $dataProvider;
    }
}
