<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%loan}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $amount
 * @property string $interest
 * @property int $duration
 * @property string $start_date
 * @property string $end_date
 * @property int $campaign
 * @property bool $status
 */
class Loan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%loan}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'amount', 'interest', 'duration', 'start_date', 'end_date', 'campaign'], 'required'],
            [['user_id', 'duration', 'campaign'], 'integer'],
            [['amount', 'interest'], 'number'],
            [['start_date', 'end_date'], 'safe'],
            [['status'], 'boolean'],
            [['start_date', 'end_date'], 'filter', 'filter' => [$this, 'toTimestamp']],
            [['user_id', 'duration', 'campaign'], 'filter', 'filter' => 'intval'],
            [['amount', 'interest'], 'filter', 'filter' => 'floatval'],
            [['status'], 'filter', 'filter' => 'boolval'],
        ];
    }

    public function toTimestamp($value)
    {
        $dt = \DateTime::createFromFormat('d-m-Y', $value);
        return $dt ? $dt->getTimestamp() : intval($value);
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'amount' => Yii::t('app', 'Amount'),
            'interest' => Yii::t('app', 'Interest'),
            'duration' => Yii::t('app', 'Duration'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'campaign' => Yii::t('app', 'Campaign'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return LoanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LoanQuery(get_called_class());
    }
}
