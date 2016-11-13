<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 28/10/2559
 * Time: 12:52 น.
 */
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Change password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="change-password-form">
<?php
    if(Yii::$app->session->hasFlash('alert'))
        echo Alert::widget([
            'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
            'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options')
        ]);
?>

<?php $form = ActiveForm::begin([
    'id' => 'profile-form',
    'options' => ['class' => 'form-vertical']
]) ?>

<?= $form->field($model, 'old_password')->passwordInput() ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>

</div>

<?php

