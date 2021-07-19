<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserFormResults;

/**
 * UserFormResultsSerach represents the model behind the search form of `common\models\UserFormResults`.
 */
class UserFormResultsSerach extends UserFormResults {
    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'create_at'], 'integer'],
            [['values', 'ref_user', 'ref_form'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = UserFormResults::find()->with(['refUser','refForm']);
        $query->joinWith(['refUser', 'refForm']);
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
            'ref_form' => $this->ref_form,
            'create_at' => $this->create_at,
        ]);
        $query->andFilterWhere(['like', 'users.name', $this->ref_user]);
        $query->andFilterWhere(['like', 'forms.name', $this->ref_form]);
        $query->andFilterWhere(['like', 'values', $this->values]);

        return $dataProvider;
    }
}
