<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\MakeHasModel;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ModelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Models';
$this->params['breadcrumbs'][] = ['label' => 'Makes', 'url' => ['/make-and-model']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Model', ['create'], ['class' => 'btn btn-success']) ?>
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
                    'delete' => function($url, $model, $key){
                        $mmRow = MakeHasModel::find()
                            ->where(['model_id' => $model->id])
                            ->count();
                        return $mmRow > 0 ? '' :
                            Html::a('<i class="glyphicon glyphicon-trash"></i>',
                                [
                                    'model/delete',
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
