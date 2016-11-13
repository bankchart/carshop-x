<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 12/10/2559
 * Time: 20:30 น.
 */
use yii\helpers\Html;
?>

<div class="span9">
    <ul class="breadcrumb">
        <li><?= Html::a('Home', ['/']) ?> <span class="divider">/</span></li>
        <li class="active">Terms and Conditions</li>
    </ul>
    <h3>Terms and Conditions</h3>
    <hr class="soft">
    <?= $model->content_text ?>
</div>

<?php
