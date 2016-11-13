<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 11/11/2559
 * Time: 6:28 น.
 */
use yii\helpers\Html;

?>

<ul class="list-group">
    <?php if($cartype->count() == 0) : ?>
        <li class="list-group-item">Empty</li>
    <?php else : ?>
        <?php foreach($cartype->all() as $type){ ?>
        <li class="list-group-item"><strong><?= $type->category->name . '</strong> : ' .
            $type->getSubCategory()->where('id=:subcatid', [':subcatid' => $type->sub_category_id])->one()->name ?>
            <span class="pull-right glyphicon glyphicon-remove"
                  onclick="if(confirm('confirm remove this item?')) models.removeCategory(<?= $type->car_id ?>, <?= $type->category_id ?>, <?= $type->sub_category_id ?>)"
                  style="cursor: pointer; color: #c90000;"></span>
        </li>
        <?php } ?>
    <?php endif; ?>
</ul>

