<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "content".
 *
 * @property integer $id
 * @property string $content_text
 * @property string $mark
 * @property integer $page_id
 *
 * @property Page $page
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_text'], 'string'],
            [['page_id'], 'required'],
            [['page_id'], 'integer'],
            [['mark'], 'string', 'max' => 45],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['page_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_text' => 'Content Text',
            'mark' => 'Mark',
            'page_id' => 'Page ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }
}
