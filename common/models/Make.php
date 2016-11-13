<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "make".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Car[] $cars
 * @property MakeHasModel[] $makeHasModels
 * @property Model[] $models
 */
class Make extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'make';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
        return $this->hasMany(Car::className(), ['make_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMakeHasModels()
    {
        return $this->hasMany(MakeHasModel::className(), ['make_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModels()
    {
        return $this->hasMany(Model::className(), ['id' => 'model_id'])->viaTable('make_has_model', ['make_id' => 'id']);
    }
}
