<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 12/10/2559
 * Time: 20:32 น.
 */
use yii\helpers\Html;
?>

<div class="span9">
    <ul class="breadcrumb">
        <li><?= Html::a('Home', ['/']) ?> <span class="divider">/</span></li>
        <li class="active">Faq</li>
    </ul>
    <h3>FAQ</h3>
    <hr class="soft">
    <?php if($model->count() <= 0) : ?>

    <span>Not found.</span>

    <?php else : ?>

    <?php $numFaq = 1; ?>
    <div class="accordion" id="faqs">

    <?php foreach($model->all() as $faq) : ?>

        <div class="accordion-group">
            <div class="accordion-heading">
                <h4>
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqs" href="#num-<?= $numFaq ?>"
                        style="padding: 0px 20px; color: #0078D7; text-decoration: none;">
                        <i class="icon-plus-sign" style="margin-top: 5px;"></i><span><?= $faq->question ?></span>
                    </a>
                </h4>
            </div>
            <div id="num-<?= $numFaq ?>" class="accordion-body collapse">
                <div class="accordion-inner"><?= $faq->anwser ?></div>
            </div>
        </div>
        <?php $numFaq++; ?>
    <?php endforeach; ?>

    </div>

    <?php endif; ?>
</div>

<?php
