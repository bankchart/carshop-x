<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Car */

$this->title = 'Update Car: ' . $model->caption;
$this->params['breadcrumbs'][] = ['label' => 'Cars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->caption, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="car-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cat' => $cat,
        'subcat' => $subcat,
        'cartype' => $cartype
    ]) ?>

</div>