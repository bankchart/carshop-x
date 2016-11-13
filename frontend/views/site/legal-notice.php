<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 12/10/2559
 * Time: 20:28 น.
 */
use yii\helpers\Html;
?>

<div class="span9">
    <ul class="breadcrumb">
        <li><?= Html::a('Home', ['/']) ?> <span class="divider">/</span></li>
        <li class="active">Legal Notice</li>
    </ul>
    <h3>Legal Notice</h3>
    <hr class="soft">
    <?= $model->content_text ?>
</div>

<?php
