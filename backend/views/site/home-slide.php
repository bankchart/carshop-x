<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 1/11/2559
 * Time: 11:09 น.
 */
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use common\models\Car;
use common\models\Slides;
use yii\widgets\Pjax;
use yii\helpers\Html;

$this->title = 'home slide';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="home-slide-view">
    <h1>Slides</h1>
    <div class="row">
        <?php $slides = $slideModel->asArray()->all(); ?>
        <?php for($i=0;$i<6;$i++) : ?>
        <div class="col-sm-6 col-md-4">
            <?php
            $temp = Car::findOne($slides[$i]['car_id']);
            $slideId = $slides[$i]['id'];
            $path = Yii::$app->request->baseUrl . '/uploads/' . $slides[$i]['photo'];
            $editCaption = $temp===null ? '' : 'onclick="location.href=\'caption?no='. $slideId .'\'"';
            ?>
            <?= Html::beginForm(['/home-slide'], 'post') ?>
            <div class="thumbnail">
                <span class="badge" style="margin-bottom: 5px;">No. <?= $slides[$i]['id'] ?></span>
                <img <?= $editCaption ?> style="height: 130px; width: 100%; cursor: pointer; margin-bottom: 4px;" src="<?= !is_file(str_replace('/backend/', '', $path)) ? Yii::$app->request->baseUrl . '/images/empty-car.png' : $path ?>">
                <div>
                    <?= Html::hiddenInput('id', $slides[$i]['id']) ?>
                    <?= Html::submitButton('Remove', [
                        'disabled' => $temp==null,
                        'class' => 'btn btn-danger',
                        'onclick' => 'return confirm("Confirm remove this item?");'
                    ]) ?>
                </div>
            </div>
            <?= Html::endForm() ?>
        </div>
        <?php endfor; ?>

    </div>
    <hr/>
    <h2>Cars</h2>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $model,
    'pjax' => true,
    'hover' => true,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function($model, $key, $index, $column) {
                $slideModel = Slides::find()
                    ->where('car.id IS NULL')
                    ->join('LEFT JOIN', 'car', 'slides.car_id = car.id')
                    ->all();
                return Yii::$app->controller->renderPartial('_car-images', [
                    'model' => $model,
                    'slideModel' => $slideModel
                ]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
        //    'expandOneOnly' => true,
        ],
        [
            'filter' => false,
            'format' => 'raw',
            'attribute' => 'thumbnail',
            'value' => function($model, $key, $index, $column){
                return $model->getPhotoViewer(['width' => '250px', 'height' => 'auto', 'app' => '']);
            }
        ],
        'caption',
        [
            'label' => 'Make & Model',
            'value' => function($model, $key, $index, $column){
                return $model->make->name . ', ' . $model->model->name;
            }
        ],
    ]
]) ?>
</div>

