<?php

use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Loan;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LoanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Loans');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="loan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Loan'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'user_id',
                'label'     => Yii::t('app', 'User'),
                'format'    => 'text',
                'content'   => function(Loan $model){
                    return $model->user->fullName;
                },
                'filter' => ArrayHelper::map(User::find()->all(), 'id', 'fullName')
            ],
            'amount',
            'interest',
            'duration',
            [
                'attribute' => 'start_date',
                'format'    => 'date',
                'filter'    => \kartik\daterange\DateRangePicker::widget([
                    'model'         => $searchModel,
                    'attribute'     => 'start_date',
                    'options'       => [
                        'autocomplete' => 'off',
                        'class'        => 'form-control'
                    ],
                    'pluginOptions' => [
                            'startDate' => '2015-04-01',
                            'endDate'   => '2015-04-01',
                            'locale'    => [
                                'format' => 'YYYY-MM-DD',
                            ]
                    ]
                ]),
            ],
            [
                'attribute' => 'end_date',
                'format'    => 'date',
                'filter'    => \kartik\daterange\DateRangePicker::widget([
                    'model'         => $searchModel,
                    'attribute'     => 'end_date',
                    'options'       => [
                        'autocomplete' => 'off',
                        'class'        => 'form-control'
                    ],
                    'pluginOptions' => [
                            'startDate' => '2015-04-01',
                            'endDate'   => '2015-04-01',
                            'locale'    => [
                                'format' => 'YYYY-MM-DD',
                            ]
                    ]
                ]),
            ],
//            'start_date:date',
//            'end_date:date',
            //'campaign',
            //'status:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
