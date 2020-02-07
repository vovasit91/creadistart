<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Loan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amount')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'interest')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'duration')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'start_date')->widget(DatePicker::class, [
        'options' => [
            'class' => 'form-control',
        ],
    ]) ?>

    <?= $form->field($model, 'end_date')->widget(DatePicker::class, [
        'options' => [
            'class' => 'form-control',
        ],
    ]) ?>

    <?= $form->field($model, 'campaign')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'fullName')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
