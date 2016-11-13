<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question')->widget(CKEditor::className(), [
        'options' => [
            'rows' => 6,
            'style' => 'display: none;'
        ],
        'preset' => 'standard-all'
    ]) ?>

    <?= $form->field($model, 'anwser')->widget(CKEditor::className(), [
        'options' => [
            'rows' => 6,
            'style' => 'display: none;'
        ],
        'preset' => 'standard-all'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
