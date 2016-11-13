<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "make_has_model".
 *
 * @property integer $make_id
 * @property integer $model_id
 *
 * @property Make $make
 * @property Model $model
 */
class MakeHasModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'make_has_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['make_id', 'model_id'], 'required'],
            [['make_id', 'model_id'], 'integer'],
            [['make_id'], 'exist', 'skipOnError' => true, 'targetClass' => Make::className(), 'targetAttribute' => ['make_id' => 'id']],
            [['model_id'], 'exist', 'skipOnError' => true, 'targetClass' => Model::className(), 'targetAttribute' => ['model_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'make_id' => 'Make ID',
            'model_id' => 'Model ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMake()
    {
        return $this->hasOne(Make::className(), ['id' => 'make_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(Model::className(), ['id' => 'model_id']);
    }
}
