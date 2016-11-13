<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 10/10/2559
 * Time: 12:28 น.
 */

namespace console\controllers;

use Yii;
use yii\helpers\Console;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        Console::output('Removing All! RBAC...');

        $loginBackend = $auth->createPermission('LoginBackend');
        $loginBackend->description = 'Login to Backend Site';
        $auth->add($loginBackend);

        $admin = $auth->createRole('Admin');
        $admin->description = 'This site of admin';
        $auth->add($admin);

        $auth->addChild($admin, $loginBackend);

        $auth->assign($admin, 1);
        Console::output('Success! RBAC roles has benn added.');
    }
    public function up() {}
}