<?php

namespace app\models\forms;

use app\models\Loan;
use app\models\User;
use Yii;
use yii\base\Model;

class LoanForm extends Model
{
    public $user_id;
    public $amount;
    public $interest;
    public $duration;
    public $start_date;
    public $end_date;
    public $campaign;

    private $loan;
    public function rules()
    {
        return [
            [['user_id', 'amount', 'interest', 'duration', 'start_date', 'end_date', 'campaign'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id'       => Yii::t('app', 'User'),
            'amount'        => Yii::t('app', 'Amount'),
            'interest'      => Yii::t('app', 'Interest'),
            'duration'      => Yii::t('app', 'Duration'),
            'start_date'    => Yii::t('app', 'Start Date'),
            'end_date'      => Yii::t('app', 'End Date'),
            'campaign'      => Yii::t('app', 'Campaign'),
        ];
    }

    public function save()
    {
        $attributes = $this->toArray();
        $loan   = new Loan($attributes);
        $result = $loan->save();
        if($result){
            $this->loan = $loan;
        }
        else {
            $this->addErrors($loan->errors);
        }
        return $result;
    }

    public function getLoan()
    {
        return $this->loan;
    }
}