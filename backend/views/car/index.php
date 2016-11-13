<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Car', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'caption',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model){
                    $status = Yii::$app->params['status'][$model->status];
                    return '<label class="label label-'.($model->status == 10 ? 'success' : 'danger').'">'.$status.'</label>';
                }
            ],
            [
                'attribute' => 'offer_status',
                'format' => 'raw',
                'value' => function($model){
                    $offerStatus = Yii::$app->params['offerStatus'][$model->offer_status];
                    return '<label class="label label-'.($model->offer_status == 10 ? 'success' : 'danger').'">'.$offerStatus.'</label>';
                }
            ],
            [
                'attribute' => 'make.name',
                'label' => 'Make'
            ],
            [
                'attribute' => 'model.name',
                'label' => 'Model'
            ],
//             'mileage',
            // 'engine',
            // 'transmission',
            // 'fuel',
            // 'drive_train',
            // 'exterior_color',
            // 'interior_color',
            // 'vehicle_type',
            // 'description:ntext',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
             [
                 'attribute' => 'thumbnail',
                 'format' => 'raw',
                 'filter' => false,
                 'value' => function($model){
                    return $model->getPhotoViewer();
                 }
             ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
