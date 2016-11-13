<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\CarType;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SubCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sub Categories';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => '/backend/category'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sub Category', ['create'], ['class' => 'btn btn-success']) ?>
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
                    'delete' => function($url, $model, $key){
                        $rows = CarType::find()
                            ->where(['sub_category_id' => $model->id])
                            ->count();
                        return $rows > 0 ? '' :
                            Html::a('<i class="glyphicon glyphicon-trash"></i>',
                                [
                                    'sub-category/delete',
                                    'id' => $model->id
                                ],
                                [
                                    'title' => 'delete',
                                    'data' => [
                                        'method' => 'post',
                                        'pjax' => '0',
                                        'confirm' => 'Are you sure you want to delete this item?'
                                    ]
                                ]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
