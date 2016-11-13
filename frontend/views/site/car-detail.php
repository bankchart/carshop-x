<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 21/10/2559
 * Time: 2:41 น.
 */
use yii\helpers\Html;
use yii\widgets\DetailView;

?>
    <div class="span9">
        <div class="row">
            <div id="gallery" class="span3">
                <?= Html::a($carModel->getPhotoViewer(['width' => '100%', 'height' => 'auto', 'app' => 'backend/']), $carModel->getUploadUrl('backend/') . $carModel->thumbnail, ['title' => $carModel->caption]) ?>
                <div id="differentview" class="moreOptopm carousel slide">
                    <div class="carousel-inner" style="padding-top: 5px;">
                        <div class="item active" style="text-align: center;">

                            <?php $photos = $carModel->photos ? @explode(',', $carModel->photos) : []; ?>

                            <?php foreach($photos as $photo) : ?>

                            <?php $imgPath = $carModel->getUploadUrl('backend/') . $photo; ?>
                            <?= Html::a(Html::img($imgPath, ['alt' => 'empty', 'style' => 'width: 80px;']), $imgPath, ['title' => $carModel->caption]) ?>

                            <?php endforeach; ?>

                        </div>
                    </div>
                    <!--
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                    -->
                </div>
            </div>
            <div class="span6">
                <h3><?= $carModel->caption ?></h3>
                <small><?= $carModel->make->name . ' ' . $carModel->model->name . ', ' . $carModel->engine . ', ' . $carModel->transmission ?></small>
                <hr class="soft">
                <form class="form-horizontal qtyFrm">
                    <div class="control-group">
                        <span style="font-size: 18px;">€<?= number_format($carModel->price1, 2) ?></span>
                        <?php if($carModel->price2 > 0) : ?>
                            <span style="font-weight: normal; font-style: italic; color: rgba(126, 133, 142, 0.84); font-size: 13px; text-decoration: line-through">€<?= number_format($carModel->price2, 2) ?></span>
                            <?php
                            $percent = ceil($carModel->price1 * 100 / $carModel->price2) - 100;
                            echo '<span class="label" style="padding: 6px; background-color: #F4313F; border-radius: 0px; font-size: 16px;">' . $percent . '%</span>';
                            ?>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <div class="span9">
                <ul id="productDetail" class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">Details</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="home">
                        <h4>Information</h4>
                        <?= DetailView::widget([
                            'model' => $carModel,
                            'template' => '<tr><th style="width: 200px;">{label}</th><td>{value}</td></tr>',
                            'attributes' => [
                                //'id',
//                                'caption',
//                                [
//                                    'attribute' => 'status',
//                                    'format' => 'raw',
//                                    'value' => '<label class="label label-'. ($model->status == 0 ? 'danger' : 'success') .'">' . $status . '</label>'
//                                ],
                                [
                                    'attribute' => 'price1',
                                    'label' => 'Price',
                                    'format' => [
                                        'currency',
                                        'EUR',
//                    [
//                        \NumberFormatter::MIN_FRACTION_DIGITS => 0,
//                        \NumberFormatter::MAX_FRACTION_DIGITS => 0,
//                    ]
                                    ],
                                ],
//                                [
//                                    'attribute' => 'price2',
//                                    'format' => [
//                                        'currency',
//                                        'EUR',
//                                    ],
//                                ],
//                                [
//                                    'attribute' => 'offer_status',
//                                    'format' => 'raw',
//                                    'value' => '<label class="label label-'. ($model->offer_status == 0 ? 'danger' : 'success') .'">' . $offerStatus . '</label>'
//                                ],
                                [
                                    'attribute' => 'make.name',
                                    'label' => 'Make'
                                ],
                                [
                                    'attribute' => 'model.name',
                                    'label' => 'Model'
                                ],
                                [
                                    'attribute' => 'mileage',
                                    'value' => number_format($carModel->mileage)
                                ],
                                'engine',
                                'transmission',
                                'fuel',
                                'drive_train',
                                'exterior_color',
                                'interior_color',
                                [
                                    'attribute' => 'vehicle_type',
                                    'value' => ucwords($carModel->vehicle_type)
                                ],
//                                'description:raw',
//                                'created_at:relativeTime',
                                'updated_at:relativeTime',
//                                'created_by',
//                                'updated_by',
//                                [
//                                    'attribute' => 'thumbnail',
//                                    'format' => 'raw',
//                                    'value' => $model->getPhotoViewer()
//                                ],
//                                [
//                                    'attribute' => 'photos',
//                                    'format' => 'raw',
//                                    'value' => $model->getPhotosViewer()
//                                ],
                            ],
                        ]) ?>
                        <?= $carModel->description ?>
                    </div>
                </div>
                <?= Html::a('Send Messages', 'about-contact', ['class' => 'btn btn-primary btn-large']) ?>
            </div>

        </div>
    </div>
    <!-- MainBody End ============================= -->
<?php //