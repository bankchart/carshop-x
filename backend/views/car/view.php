<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Car */

$this->title = $model->caption;
$this->params['breadcrumbs'][] = ['label' => 'Cars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
        $status = Yii::$app->params['status'][$model->status];
        $offerStatus = Yii::$app->params['offerStatus'][$model->offer_status];
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th style="width: 200px;">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            //'id',
            'caption',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => '<label class="label label-'. ($model->status == 0 ? 'danger' : 'success') .'">' . $status . '</label>'
            ],
            [
                'attribute' => 'price1',
                'format' => [
                    'currency',
                    'EUR',
//                    [
//                        \NumberFormatter::MIN_FRACTION_DIGITS => 0,
//                        \NumberFormatter::MAX_FRACTION_DIGITS => 0,
//                    ]
                ],
            ],
            [
                'attribute' => 'price2',
                'format' => [
                    'currency',
                    'EUR',
                ],
            ],
            [
                'attribute' => 'offer_status',
                'format' => 'raw',
                'value' => '<label class="label label-'. ($model->offer_status == 0 ? 'danger' : 'success') .'">' . $offerStatus . '</label>'
            ],
            [
                'attribute' => 'make.name',
                'label' => 'Make'
            ],
            [
                'attribute' => 'model.name',
                'label' => 'Model'
            ],
            'mileage',
            'engine',
            'transmission',
            'fuel',
            'drive_train',
            'exterior_color',
            'interior_color',
            [
                'attribute' => 'vehicle_type',
                'value' => ucwords($model->vehicle_type)
            ],
            'description:raw',
            'created_at:relativeTime',
            'updated_at:relativeTime',
            'created_by',
            'updated_by',
            [
                'attribute' => 'thumbnail',
                'format' => 'raw',
                'value' => $model->getPhotoViewer()
            ],
            [
                'attribute' => 'photos',
                'format' => 'raw',
                'value' => $model->getPhotosViewer()
            ],
        ],
    ]) ?>

</div>
