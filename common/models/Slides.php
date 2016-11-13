<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\TimestampBehaviors;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "slides".
 *
 * @property integer $id
 * @property integer $car_id
 * @property string $photo
 * @property string $caption
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class Slides extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slides';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['car_id'], 'required'],
            [['car_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['photo', 'caption'], 'string'],
//            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::className(), 'targetAttribute' => ['car_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_id' => 'Car ID',
            'photo' => 'Photo',
            'caption' => 'Caption',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }
}
