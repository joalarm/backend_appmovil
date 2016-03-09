<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductoServicio;
use \yii\db\Query;

/**
 * BusquedaProductoServicio represents the model behind the search form about `app\models\ProductoServicio`.
 */
class BusquedaProductoServicio extends ProductoServicio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Es_producto'], 'integer'],
            [['Nombre', 'Descripcion', 'Precio', 'Imagen'], 'safe'],
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
    	$queryEstProdserv = (new Query())
    						->select('Prodserv_id')
    						->from('est_prodserv')
    						->where('Est_id=:est',[':est' => $establecimiento]);
    	$query = ProductoServicio::find()
        ->where(['in','id',$queryEstProdserv]);

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
            'Es_producto' => $this->Es_producto,
        ]);

        $query->andFilterWhere(['like', 'Nombre', $this->Nombre])
            ->andFilterWhere(['like', 'Descripcion', $this->Descripcion])
            ->andFilterWhere(['like', 'Precio', $this->Precio])
            ->andFilterWhere(['like', 'Imagen', $this->Imagen]);

        return $dataProvider;
    }
}
