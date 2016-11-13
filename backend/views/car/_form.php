<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\db\Query;
use common\models\Make;
use common\models\Image;
use common\models\Model;
use common\models\MakeHasModel;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Car */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'caption')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price1')->textInput() ?>

    <?= $form->field($model, 'price2')->textInput() ?>

    <div class="form-group">
        <label for="status"><?= $model->attributeLabels()['status'] ?></label>
        <select class="form-control" name="Car[status]" id="status">
            <option value>choose status</option>

    <?php foreach(Yii::$app->params['status'] as $key => $status) : ?>
            <option <?= $key == $model->status && !$model->isNewRecord ? 'selected="selected"' : '' ?>
                value="<?= $key ?>"><?= $status ?>
            </option>
    <?php endforeach; ?>

        </select>
    </div>

    <div class="form-group">
        <label for="offer_status"><?= $model->attributeLabels()['offer_status'] ?></label>
        <select class="form-control" name="Car[offer_status]" id="offer_status">
            <option value>choose offer-status</option>

            <?php foreach(Yii::$app->params['offerStatus'] as $key => $offerStatus) : ?>
                <option <?= $key == $model->offer_status && !$model->isNewRecord ? 'selected="selected"' : '' ?>
                    value="<?= $key ?>"><?= $offerStatus ?>
                </option>
            <?php endforeach; ?>

        </select>
    </div>

    <div class="form-group">
        <label for="make_id"><?= $model->attributeLabels()['make_id'] ?></label>
        <?php
        $make = Make::find();

        echo Html::dropDownList('Car[make_id]', $model->make_id, ArrayHelper::map($make->all(), 'id', 'name'),
            [
                'id' => 'make_id',
                'class' => 'form-control',
                'prompt' => 'choose make',
                'onchange' => 'models.getModelByMake("'. Yii::$app->request->baseUrl .'", this)'
            ]);
        ?>
    </div>

    <div class="form-group">
        <label for="model_id"><?= $model->attributeLabels()['model_id'] ?></label>
        <?php
        $modelCar = (new Query())
                ->select('id, name')
                ->from('make_has_model')
                ->leftJoin('model', 'model_id = id')
                ->where(['make_id' => $model->make_id])
                ->orderBy(['name' => SORT_ASC]);
        $key = array_search($model->model_id, array_column($modelCar->all(), 'id'));
        echo Html::dropDownList('Car[model_id]', is_int($key) ? $model->model_id : null,
                ArrayHelper::map($modelCar->all(), 'id', 'name'),
            [
                'id' => 'model_id',
                'class' => 'form-control',
                'prompt' => 'choose model'
            ]);
        ?>
    </div>

    <?php if(!$model->isNewRecord) : ?>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <label class="control-label" for="category-name">Category</label>
                <?= Html::dropDownList('Category[name]', null, ArrayHelper::map($cat->all(), 'id', 'name'), [
                    'prompt' => 'choose...',
                    'id' => 'category_id',
                    'onchange' => 'models.getSubCatByCat(this);',
                    'class' => 'form-control'
                ]) ?>
            </div>
            <div class="col-sm-6 col-md-6">
                <label class="control-label" for="subcategory-name">Sub-category</label>
                <?= Html::dropDownList('SubCategory[name]', null, [], [
                    'prompt' => 'choose...',
                    'id' => 'sub-category_id',
                    'onchange' => 'models.updateDisplayCategory(this);',
                    'data-carid' => $model->id,
                    'class' => 'form-control'
                ]) ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Categories</label>
        <div class="row">
            <div id="display-category" class="col-md-6">
            <?php
                echo $this->render('_category-detail', [
                    'cartype' => $cartype
                ]);
            ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?= $form->field($model, 'mileage')->textInput() ?>

    <?= $form->field($model, 'engine')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exterior_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interior_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => [
            'rows' => 6,
            'style' => 'display: none;'
        ],
        'preset' => 'standard-all'
    ]) ?>

    <?= $form->field($model, 'thumbnail')->widget(FileInput::className(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showUpload' => false
        ]
    ]) ?>

    <div class="well">
        <?= $model->getPhotoViewer() ?>
    </div>

    <?= $form->field($model, 'photos[]')->widget(FileInput::className(), [
        'options' => ['accept' => 'image/*', 'multiple' => true],
        'pluginOptions' => [
            'showUpload' => false
        ]
    ]) ?>
    <div class="well">
        <?= $model->getPhotosViewer(); ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
