<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Car;

/**
 * CarSearch represents the model behind the search form about `common\models\Car`.
 */
class CarSearch extends Car
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'offer_status', 'make_id', 'model_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['caption', 'engine', 'transmission', 'fuel', 'drive_train', 'exterior_color', 'interior_color', 'vehicle_type', 'description', 'thumbnail'], 'safe'],
            [['mileage'], 'number'],
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
        $query = Car::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'offer_status' => $this->offer_status,
            'make_id' => $this->make_id,
            'model_id' => $this->model_id,
            'mileage' => $this->mileage,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'caption', $this->caption])
            ->andFilterWhere(['like', 'engine', $this->engine])
            ->andFilterWhere(['like', 'transmission', $this->transmission])
            ->andFilterWhere(['like', 'fuel', $this->fuel])
            ->andFilterWhere(['like', 'drive_train', $this->drive_train])
            ->andFilterWhere(['like', 'exterior_color', $this->exterior_color])
            ->andFilterWhere(['like', 'interior_color', $this->interior_color])
            ->andFilterWhere(['like', 'vehicle_type', $this->vehicle_type])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'thumbnail', $this->thumbnail]);

        return $dataProvider;
    }
}
