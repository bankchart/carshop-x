<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 10/10/2559
 * Time: 12:34 น.
 */

namespace common\rbac;

use yii\rbac\Rule;

class AdminRule extends Rule
{
    public $name = 'isAdmin';
    public function execute($user_id, $item, $params)
    {
        return isset($params['role']) ? $params['role'] == 'Admin' : false;
    }
}