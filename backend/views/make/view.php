<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\models\Make;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model common\models\Make */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Makes', 'url' => ['/make-and-model']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="make-view">

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
        'template' => '<tr><th style="width: 200px;">{label}</th><td>{value}</td></tr>',
        'attributes' => [
         //   'id',
            'name',
        ],
    ]) ?>

</div>

<?php

$test = Make::find();
$dataProvider = new ActiveDataProvider([
    'query' => $test
]);

$query = (new Query())
    ->select('model.name as name, model.id as id')
    ->from('make_has_model')
    ->leftJoin('model', 'make_has_model.model_id = model.id')
    ->leftJoin('make', 'make_has_model.make_id = make.id')
    ->where(['make_has_model.make_id' => $model->id]);

$provider = new ActiveDataProvider([
    'query' => $query
]);

?>

<div class="make-model">
    <h3><?= Html::encode('Models') ?></h3>
    <p>
        <label>Add to <?= $this->title ?></label>
        <?= Html::dropDownList(
            'models', null, $models,
            [
                'prompt' => 'choose model',
                'class' => 'form-control',
                'id' => 'models',
                'onchange' => 'models.assign2Make("'. Yii::$app->request->baseUrl .'", '. $model->id .', this.value);'
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
                        ['/delete-model/' . $q['id'] . '/' . $model->id],
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
