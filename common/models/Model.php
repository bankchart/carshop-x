<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "model".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Car[] $cars
 * @property MakeHasModel[] $makeHasModels
 * @property Make[] $makes
 */
class Model extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 120],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCars()
    {
        return $this->hasMany(Car::className(), ['model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMakeHasModels()
    {
        return $this->hasMany(MakeHasModel::className(), ['model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMakes()
    {
        return $this->hasMany(Make::className(), ['id' => 'make_id'])->viaTable('make_has_model', ['model_id' => 'id']);
    }
}
