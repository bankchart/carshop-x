<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Manage Sub-Category', ['/sub-category'], ['class' => 'btn btn-default']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function($url, $model, $key) use ($catIds){
                        return in_array($model->id, $catIds) ? '' :
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
