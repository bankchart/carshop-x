<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 11/11/2559
 * Time: 15:14 น.
 */
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Mail';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Mail</h1>
<?php
if(Yii::$app->session->hasFlash('alert')){
    $temp = Yii::$app->session->getFlash('alert');
    echo Alert::widget([
        'body' => ArrayHelper::getValue($temp, 'body'),
        'options' => ArrayHelper::getValue($temp, 'options'),
    ]);
}
?>
<?php $form = ActiveForm::begin([
    'id' => 'mail-form',
    'options' => ['class' => 'form-vertical']
]) ?>

<?= $form->field($model, 'email')->textInput() ?>
<?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>

<?php

