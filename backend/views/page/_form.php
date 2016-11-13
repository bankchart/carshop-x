<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use dosamigos\ckeditor\CKEditorInline;
use common\models\Content;

$index = 0;
/* @var $this yii\web\View */
/* @var $model common\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php foreach($contentModel as $content) : ?>
    <?php
        $tempModel = Content::findOne($content->id);
    ?>
    <div class="form-group">
        <?= $form->field($tempModel, 'content_text')->label($tempModel->mark)->widget(CKEditor::className(), [
            'options' => [
                'rows' => 6,
                'name' => 'contents[' . $tempModel->mark . ']',
                'id' => $tempModel->mark,
                'style' => 'display: none;'
            ],
            'preset' => 'standard-all'
        ]) ?>
    </div>

    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
