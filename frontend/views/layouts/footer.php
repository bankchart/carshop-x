<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 9/10/2559
 * Time: 19:03 น.
 */
use yii\helpers\Html;
use common\models\Social;
?>
<div id="footerSection" style="padding-left: 5px; padding-right: 5px;">
    <div class="container">
        <div class="row">
            <div class="span3">
                <h5>INFORMATION</h5>
                <a href="<?= Yii::$app->request->baseUrl ?>/about-contact">ABOUT / CONTACT</a>
                <a href="<?= Yii::$app->request->baseUrl ?>/legal-notice">LEGAL NOTICE</a>
                <a href="<?= Yii::$app->request->baseUrl ?>/terms-and-conditions">TERMS AND CONDITIONS</a>
                <a href="<?= Yii::$app->request->baseUrl ?>/faq.s">FAQ</a>
            </div>
            <div class="span3">
                <h5>OUR OFFERS</h5>
                <?= Html::a('NEW PRODUCTS', ['/new-car']) ?>
                <?= Html::a('SPECIAL OFFERS', ['/special-offer']) ?>
            </div>
            <div id="socialMedia" class="span3 pull-right">
                <h5>SOCIAL MEDIA </h5>
                <?php
                $facebook = Social::find()->where(['name' => 'Facebook'])->one();
                $twitter = Social::find()->where(['name' => 'Twitter'])->one();
                $youtube = Social::find()->where(['name' => 'Youtube'])->one();
                ?>
                <a target="_blank" href="http://<?= $facebook->link ?>"><img width="60" height="60" src="images/facebook.png" title="facebook" alt="facebook"/></a>
                <a target="_blank" href="http://<?= $twitter->link ?>"><img width="60" height="60" src="images/twitter.png" title="twitter" alt="twitter"/></a>
                <a target="_blank" href="http://<?= $youtube->link ?>"><img width="60" height="60" src="images/youtube.png" title="youtube" alt="youtube"/></a>
            </div>
        </div>
    </div><!-- Container End -->
</div>

