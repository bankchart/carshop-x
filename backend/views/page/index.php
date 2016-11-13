<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function($url, $model, $key){
                        return Html::a('<i class="fa fa-eye"></i>', ['/page/' . str_replace(' ', '_', $model->name)]);
                    },
                    'update' => function($url, $model, $key){
                        return Html::a('<i class="fa fa-pencil"></i>', ['/page/update/' . str_replace(' ', '_', $model->name)]);
                    },
                    'delete' => function(){}
                ]
            ],
        ],
    ]); ?>
</div>
