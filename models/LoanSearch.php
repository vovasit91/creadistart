<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Loan;

/**
 * LoanSearch represents the model behind the search form of `app\models\Loan`.
 */
class LoanSearch extends Loan
{
    public $start_date_from;
    public $start_date_to;
    public $end_date_from;
    public $end_date_to;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'duration', 'campaign'], 'integer'],
            [['amount', 'interest'], 'number'],
            [['start_date', 'end_date'], 'safe'],
            [['status'], 'boolean'],
        ];
    }

    public function startDateToParts($value)
    {
        $dates = explode(' - ', $value);
        if(count($dates) === 2){
            $this->start_date_from  = strtotime($dates[0]);
            $this->start_date_to    = strtotime($dates[1]);
        }
    }

    public function endDateToParts($value)
    {
        $dates = explode(' - ', $value);
        if(count($dates) === 2){
            $this->end_date_from  = strtotime($dates[0]);
            $this->end_date_to    = strtotime($dates[1]);
        }
    }

    /**
     * {@inheritdoc}
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
        $query = Loan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $this->startDateToParts($params['LoanSearch']['start_date']);
        $this->endDateToParts($params['LoanSearch']['end_date']);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'interest' => $this->interest,
            'duration' => $this->duration,
            'campaign' => $this->campaign,
            'status' => $this->status,
        ]);
        $query->andFilterWhere(['between', 'start_date', $this->start_date_from, $this->start_date_to]);
        $query->andFilterWhere(['between', 'end_date', $this->end_date_from, $this->end_date_to]);

        return $dataProvider;
    }
}
