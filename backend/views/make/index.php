<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MakeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Makes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="make-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Make', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Manage Model', ['/manage-model'], ['class' => 'btn btn-default']) ?>
    </p>
    <?php // print_r($query, true) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'id',
            'name',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function($url, $model, $key) use ($makeIds){
                        return in_array($model->id, $makeIds) ? '' :
                            Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete?id=' . $model->id], [
                                'title' => 'Delete',
                                'aria-label' => 'Delete',
                                'data' => [
                                    'confirm' => 'Are your sure you want to delete this item?',
                                    'method' => 'post',
                                    'pjax' => 0
                                ]
                            ]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
