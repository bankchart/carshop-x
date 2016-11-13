<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 6/10/2559
 * Time: 20:36 น.
 */
use yii\helpers\Html;
use common\models\Car;
use common\models\Category;
use common\models\CategoryHasSubCategory;
use common\models\CarType;
?>
<!-- Sidebar ================================================== -->
<div id="sidebar" class="span3">
    <ul id="sideManu" class="nav nav-tabs nav-stacked" style="/*border-bottom: 1px solid #DDD;*/">
        <?php
        $category = Category::find();
        $open = false;
        ?>
        <?php foreach($category->all() as $cat) : ?>
            <li class="subMenu<?= $open ? ' open' : '' ?>">
                <?php
                $catsub = CategoryHasSubCategory::find()
                    ->where(['category_id' => $cat->id]);
                ?>
                <a><?= strtoupper($cat->name) . '[' . $catsub->count() . ']' ?></a>
                <?php if($catsub->count() > 0) : ?>
                    <ul>
                        <?php foreach($catsub->all() as $cs) : ?>
                            <?php
                            $subname = $cs->getSubCategory()->where(['id' => $cs->sub_category_id])->one();
                            $cartype = CarType::find()
                                ->where(['category_id' => $cs->category_id, 'sub_category_id' => $cs->sub_category_id]);
                            ?>
                            <li>
                                <a href="<?= Yii::$app->request->baseUrl
                                . '/car-list?'. urlencode(strtolower(substr($cat->name, 0, 1))) .'='
                                . urlencode($subname->name) ?>">
                                    <i class="icon-chevron-right"></i><?= ucwords($subname->name) ?>
                                    <?= $cartype->count() > 0 ? '<span style="margin-right: 15px; margin-top: 2px; 
                                    background-color: #496b8e;" class="pull-right badge">' . $cartype->count() . '</span>' : '' ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
            <?php $open = false; ?>
        <?php endforeach; ?>
    </ul>
    <br/>

    <!--<div class="thumbnail">
        <img src="images/products/panasonic.jpg" alt="Bootshop panasonoc New camera"/>
        <div class="caption">
            <h5>Panasonic</h5>
            <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">$222.00</a></h4>
        </div>
    </div><br/>
    <div class="thumbnail">
        <img src="images/products/kindle.png" title="Bootshop New Kindel" alt="Bootshop Kindel">
        <div class="caption">
            <h5>Kindle</h5>
            <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">$222.00</a></h4>
        </div>
    </div>-->
</div>
<!-- Sidebar end=============================================== -->
<?php
