<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 21/10/2559
 * Time: 21:31 น.
 */
use yii\helpers\Html;
use common\models\Car;
$params = array_values(Yii::$app->request->queryParams);
?>

<div class="span9">
    <ul class="breadcrumb">
        <li><?= Html::a('Home', ['/']) ?> <span class="divider">/</span></li>
        <li class="active">Search Results</li>
    </ul>
    <h3 style="font-weight: normal">Search by "<?= $params[0] ?>"</h3>
    <hr class="soft">
    <div class="thumbnails" style="margin-left: 0px;">

        <?php if($model == null) : ?>

            <div class="span3">Not found.</div>

        <?php else : ?>

            <?php foreach($model as $car) : ?>

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

        <?php endif; ?>

    </div>
    <div class="pagination">
        <?php
        $baseUrl = Yii::$app->request->baseUrl;
        ?>
        <ul>
            <li class="<?= count($pages) == 1 || $p == 1 ? 'active' : '' ?>">
                <a onclick="<?= count($pages) == 1 || $p == 1 ? 'return false;' : '' ?>"
                   href="<?= $p > 1 ? $baseUrl . '/car-list?'.$keySearch.'='.$search.'&p=' . ($p-1) : '#' ?>" >‹</a>
            </li>
            <?php foreach($pages as $key => $status) : ?>
                <li class="<?= $status ?>"><a onclick="<?= $status == 'active' ? 'return false;' : '' ?>" href="<?= $status == '' ? $baseUrl . '/car-list?'.$keySearch.'='.$search.'&p=' . ($key+1) : '#' ?>"><?= $key+1 ?></a></li>
            <?php endforeach; ?>
            <li class="<?= count($pages) == 1 || $p == $totalPage ? 'active' : '' ?>">
                <a onclick="<?= count($pages) == 1 || $p == $totalPage ? 'return false;' : '' ?>"
                   href="<?= $p < $totalPage ? $baseUrl . '/car-list?'.$keySearch.'='.$search.'&p=' . ($p+1) : '#' ?>" >›</a>
            </li>
        </ul>
    </div>
</div>

<?php //
