<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 4/11/2559
 * Time: 10:38 น.
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Alert;

$this->title = 'Edit Caption';
$this->params['breadcrumbs'][] = ['label' => 'home slide', 'url' => ['/home-slide']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caption-slide-view">
    <h1>Caption</h1>
    <?php
    if(Yii::$app->session->hasFlash('alert')){
        $temp = Yii::$app->session->getFlash('alert');
        echo Alert::widget([
            'body' => ArrayHelper::getValue($temp, 'body'),
            'options' => ArrayHelper::getValue($temp, 'options'),
        ]);
    }
    ?>
    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['class' => 'form-horizontal']) ?>
            <div class="form-group field-slides-photo">
                <label class="control-label"><?= $model->attributeLabels()['photo'] ?></label>
                <?= Html::img(Yii::$app->request->baseUrl . '/uploads/' . $model->photo, ['class' => 'img-responsive', 'style' => 'width: 100%;']) ?>
            </div>
            <?= $form->field($model, 'caption')->widget(\dosamigos\ckeditor\CKEditor::className(), [
                'options' => [
                    'rows' => 6,
                    'style' => 'display: none;'
                ],
                'preset' => 'full'
            ]) ?>
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
