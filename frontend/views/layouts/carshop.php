<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 6/10/2559
 * Time: 20:29 น.
 */

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use frontend\assets\Carshop;
use common\models\Car;
use common\models\Slides;
use common\models\CarType;
use yii\db\Query;

Carshop::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->name) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="header">
    <div class="container">
        <div id="welcomeLine" class="row">
            <div class="span6">Welcome!</div>
        </div>
        <!-- Navbar ================================================== -->
        <div id="logoArea" class="navbar">
            <a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-inner" style="border-radius: 0px;">
                <a class="brand" href="/"><img src="images/logo.png" alt="Bootsshop"/></a>
                <form class="form-inline navbar-search" method="get" action="<?= Yii::$app->request->baseUrl . '/car-list' ?>" >
                    <input placeholder="Search..." name="srch-text" class="srchTxt" type="text" />
                    <select onchange="Carshop.searchByType(this);" class="srchTxt">
                        <option value="choose">Choose...</option>
                        <?php
                        $cartype = (new Query())
                        ->select('COUNT(*) as cnt, sub_category.name as sub')
                        ->from('car_type')
                        ->join('LEFT JOIN', 'sub_category', 'car_type.sub_category_id = sub_category.id')
                        ->groupBy('sub_category_id')
                        ->createCommand()
                        ->queryAll();
                        ?>
                        <?php foreach($cartype as $type) {
                            print_r($type);
                            $subtype = $type['sub'];
                            echo '<option value="' . Yii::$app->request->baseUrl . '/car-list?all=' .
                                urlencode($subtype) . '">' . $subtype . '(' . $type['cnt'] . ')</option>';
                        }
                      ?>
                    </select>
                    <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
                </form>
                <ul id="topMenu" class="nav pull-right">
                    <li class=""><?= Html::a('Specials Offer', ['/special-offer']) ?></li>
                    <li class=""><?= Html::a('About / Contact', Yii::$app->request->baseUrl . '/about-contact') ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Header End====================================================================== -->
<?php if(Yii::$app->controller->action->id == 'index') : ?>
<?php
    $slideModel = Slides::find()
        ->where('slides.car_id > 0')
        ->join('LEFT JOIN', 'car', ['slides.car_id' => 'car.id'])
        ->all();
    $active = true;
?>
<div id="carouselBlk">
    <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">

            <?php foreach($slideModel as $slide) : ?>

            <div class="item <?= $active ? 'active' : '' ?>" style="height: auto;">
                <?php $active = $active ? false : false; ?>
                <div class="container">
                    <?= Html::a(
                            Html::img('/backend/uploads/' . $slide->photo, [
                                'style' => 'width: 100%; height: 480px;'
                            ]),
                            ['/car-detail?id=' . $slide->car_id]
                    ) ?>
                    <div class="carousel-caption"><?= $slide->caption ?></div>
                </div>
            </div>

            <?php endforeach; ?>

        </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
</div>

<?php endif; ?>

<div id="mainBody">
    <div class="container">
        <div class="row">
            <?php /* span3 */ ?>
            <?= $this->render('sidebar.php') ?>
            <?php /* span9 */ ?>
            <?= $content ?>
        </div>
    </div>
</div>
<?= $this->render('footer.php') ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
