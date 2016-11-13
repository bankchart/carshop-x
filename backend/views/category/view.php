<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name',
        ],
    ]) ?>

</div>

<?php
// resolve....coding...
$query = (new Query())
    ->select('sub_category.name as name, sub_category.id as id')
    ->from('category_has_sub_category')
    ->leftJoin('sub_category', 'category_has_sub_category.sub_category_id = sub_category.id')
    ->leftJoin('category', 'category_has_sub_category.category_id = category.id')
    ->where(['category_has_sub_category.category_id' => $model->id]);

$provider = new ActiveDataProvider([
    'query' => $query
]);

?>

<div class="category-subcat">
    <h3><?= Html::encode('Sub Categories') ?></h3>
    <p>
        <label>Add to <?= $this->title ?></label>
        <?= Html::dropDownList(
            'models', null, $models,
            [
                'prompt' => 'choose model',
                'class' => 'form-control',
                'id' => 'models',
                'onchange' => 'models.assign2Category('. $model->id .', this.value);'
            ]) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $provider,
//        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',

            [
                'format' => 'raw',
                'value' => function($q) use ($model){
                    return Html::a(
                        '<i class="glyphicon glyphicon-trash"></i>',
                        ['/delete-sub-category/' . $q['id'] . '/' . $model->id],
                        [
                            'title' => 'delete',
                            'data-method' => 'post',
                            'data-confirm' => 'Are you sure you want to delete this item?',
                            'data-pjax' => '0'
                        ]
                    );
                }

            ],
        ],
    ]); ?>

</div>
