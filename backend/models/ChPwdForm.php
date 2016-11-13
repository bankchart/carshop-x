<?php
/**
 * Created by PhpStorm.
 * User: bankchart
 * Date: 28/10/2559
 * Time: 13:07 น.
 */
namespace backend\models;

use Yii;
use common\models\User;
use yii\base\Model;

class ChPwdForm extends Model
{
    public $password;
    public $old_password;


    public function rules()
    {
        return [
            [['password', 'old_password'], 'required'],
            [['password', 'old_password'], 'string', 'min' => 5]
        ];
    }

    public function update()
    {
        if(!$this->validate())
            return null;
        $user = User::findOne(Yii::$app->user->id);
        if($user->validatePassword($this->old_password))
            $user->setPassword($this->password);
        else
            return null;
        return $user->save() ? $user : null;

    }
}