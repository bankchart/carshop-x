<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Update', ['/page/update/' . str_replace(' ', '-', $model->name)], ['class' => 'btn btn-primary']) ?>
        <?php

        /*echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);*/

        ?>
    </p>
    <?php
        $contents = '';
        foreach($model->contents as $content){
            $contents .= '<label style="font-size: 12px;" class="label label-danger">'. $content->mark .' :</label><br/><br/>' . ($content->content_text == '' ? 'empty' : $content->content_text) . '<br/><br/>';
        }
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th style="width: 200px;">{label}</th><td>{value}</td></tr>',
        'attributes' => [
         //   'id',
            'name',
            [
                'attribute' => 'contents',
                'value' => $contents,
                'format' => 'raw'
            ]
        ],
    ]) ?>

</div>
