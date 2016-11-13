<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 2/11/2559
 * Time: 10:45 น.
 */
use yii\helpers\Html;

$images = $model->photos ? @explode(',', $model->photos) : [];
?>
<div class="row">
<?php foreach($images as $img) : ?>
    <div class="col-sm-3">
        <div class="thumbnail">
            <?= Html::img(Yii::$app->request->baseUrl . '/uploads/' . $img,
                [
                    'onclick' => 'models.chooseSlide($(this));',
                    'style' => 'cursor:pointer;',
                    'class' => 'img-slide-'. $model->id .' img-gray'
                ]) ?>
        </div>
    </div>
<?php endforeach; ?>
</div>
<div class="row">
    <div class="col-md-12 form-inline text-right">
        <?= Html::beginForm(['/home-slide'], 'post', ['data-pjax' => false]) ?>
        <select name="slide-no" class="form-control">
            <option value="-1">Choose No</option>
            <?php foreach($slideModel as $m) : ?>
                <option value="<?= $m->id ?>">No. <?= $m->id ?></option>
            <?php endforeach; ?>
        </select>
        <?= Html::hiddenInput('id-src', null, ['id' => 'id-src-' . $model->id]) ?>
        <hr/>
    </div>

</div>
<?= Html::submitButton('Update', [
    'id' => 'choose-slide-' . $model->id,
    'class' => 'btn btn-primary pull-right',
    'onclick' => 'models.addSlide($(this));',
    'data-id-src' => 'empty',
]) ?>
<?= Html::endForm() ?>
