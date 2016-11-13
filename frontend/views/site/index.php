<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 6/10/2559
 * Time: 20:28 น.
 */
use yii\helpers\Html;
use common\models\Car;
?>
<div class="span9">
    <div class="well well-small">
        <h4>Featured Products x
            <?php /* <small class="pull-right">200+ featured products</small> */ ?>
        </h4>
        <div class="row-fluid">
            <div id="featured" class="carousel slide">
                <div class="carousel-inner">

                    <?php
                        $carModel = Car::find()
                            ->where(['status' => Car::STATUS_ACTIVE, 'offer_status' => Car::OFFER_STATUS_ACTIVE])
                            ->orderBy(['updated_at' => SORT_DESC])
                            ->limit(12);
                        $numFeature = $carModel->count();
                        $carsArray = $carModel->createCommand()->queryAll();
                        $active = true;
                        $count = 0;
                    ?>

                    <?php foreach($carsArray as $key => $car) : ?>
                    <?php if($count == 0) : ?>

                    <div class="item <?= $active ? 'active' : '' ?>"> <?php if($active) $active = false; ?>
                        <ul class="thumbnails">

                    <?php endif; ?>
                            <li class="span4">
                                <div class="thumbnail" style="height: 245px;">
                                    <?php
                                        $model = Car::findOne($car['id']);
                                        echo Html::a($model->getPhotoViewer(['width' => '220px', 'height' => 'auto', 'app' => 'backend/']), ['/car-detail', 'id' => $car['id']])
                                    ?>
                                    <div class="caption">
                                        <h6 class="wrap-detail-dot-x"><?= Html::a($car['caption'], ['/car-detail', 'id' => $car['id']]) ?></h6>
                                        <div style="text-align: right;">
                                            <span style="font-weight: bold;">€<?= number_format($car['price1'], 2) ?></span>
                                            <?php if($car['price2'] > 0) : ?>
                                                <span style="text-decoration: line-through;">€<?= number_format($car['price2'], 2) ?></span>
                                                <?php
                                                $percent = ceil($car['price1'] * 100 / $car['price2']) - 100;
                                                echo '<div class="label" style="padding: 6px; background-color: #F4313F; border-radius: 0px; font-size: 12px;">' . $percent . '%</div>';
                                                ?>
                                            <?php endif; ?>
                                        </div>
                                        <hr class="soft">
                                        <?= Html::a('VIEW', ['/car-detail', 'id' => $car['id']], [
                                            'class' => 'btn btn-small pull-right']) ?>
                                    </div>
                                </div>
                            </li>
                    <?php if($count == 2 || $key == count($carsArray)-1) : ?>

                        </ul>
                    </div>
                    <?php $count = 0; ?>
                    <?php else : ?>
                    <?php $count++; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>

                </div>
                <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#featured" data-slide="next">›</a>
            </div>
        </div>
    </div>

    <h4>Latest Products </h4>
    <div id="latest-products" class="row-fluid">
        <?php
            $lastCarModel = Car::find()
                ->where(['status' => Car::STATUS_ACTIVE])
                ->orderBy(['updated_at' => SORT_DESC])
                ->limit(50)
                ->all();
        ?>
        <?php if(count($lastCarModel) == 0) : ?>
            <div class="span9">
                <div class="page-header">
                    <h1><small>Not found.</small></h1>
                </div>
            </div>
        <?php endif; ?>
        <?php foreach($paginationModel as $car) : ?>
        <div class="span3" style="height: 315px; margin-left: 0px; margin-right: 15px; min-width: 201px !important;">
            <div class="thumbnail" style="margin-bottom: 5px;">
                <?= Html::a($car->getPhotoViewer(['width' => '250px', 'height' => '100px', 'app' => 'backend/']), ['/car-detail', 'id' => $car['id']]) ?>
                <div class="caption" style="text-align: center;">
                    <h5 class="wrap-detail-dot-x"><?= Html::a($car->caption, ['/car-detail', 'id' => $car['id']]) ?></h5>
                    <div class="wrap-detail-dot-y"><?= $car->description ?></div>
                    <?= Html::a('Read more...', ['/car-detail', 'id' => $car['id']], ['class' => 'btn btn-detaul']) ?>
                    <h5 style="text-align:center">
                        <span style="font-size: 11px;">€<?= number_format($car->price1, 2) ?></span>
                        <?php if($car->price2 > 0) : ?>
                        <span style="font-weight: normal; font-style: italic;
                            color: rgba(126, 133, 142, 0.84); font-size: 9px;
                            text-decoration: line-through">
                            €<?= number_format($car->price2, 2) ?>
                        </span>
                        <?php
                            $percent = ceil($car->price1 * 100 / $car->price2) - 100;
                            echo '<span class="label pull-right" style="padding: 6px; background-color: #F4313F; border-radius: 0px; font-size: 16px;">' . $percent . '%</span>';
                        ?>
                        <?php endif; ?>
                    </h5>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="pagination">
        <?php
            $baseUrl = Yii::$app->request->baseUrl;
        ?>
        <ul>
            <li class="<?= count($pages) == 1 || $p == 1 ? 'active' : '' ?>">
                <a onclick="<?= count($pages) == 1 || $p == 1 ? 'return false;' : '' ?>"
                   href="<?= $p > 1 ? $baseUrl . '?p=' . ($p-1) . '#latest-products' : '#' ?>" >‹</a>
            </li>
            <?php foreach($pages as $key => $status) : ?>
            <li class="<?= $status ?>"><a onclick="<?= $status == 'active' ? 'return false;' : '' ?>" href="<?= $status == '' ? $baseUrl . '?p=' . ($key+1) . '#latest-products' : '#' ?>"><?= $key+1 ?></a></li>
            <?php endforeach; ?>
            <li class="<?= count($pages) == 1 || $p == $totalPage ? 'active' : '' ?>">
                <a onclick="<?= count($pages) == 1 || $p == $totalPage ? 'return false;' : '' ?>"
                   href="<?= $p < $totalPage ? $baseUrl . '?p=' . ($p+1) . '#latest-products' : '#' ?>" >›</a>
            </li>
        </ul>
    </div>

</div>
