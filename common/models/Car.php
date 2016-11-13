<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\Html;
//use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "car".
 *
 * @property integer $id
 * @property string $caption
 * @property integer $status
 * @property integer $offer_status
 * @property integer $make_id
 * @property integer $model_id
 * @property double $mileage
 * @property string $engine
 * @property string $transmission
 * @property string $fuel
 * @property string $drive_train
 * @property string $exterior_color
 * @property string $interior_color
 * @property string $vehicle_type
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $thumbnail
 * @property double $price1
 * @property double $price2
 *
 * @property Make $make
 * @property Model $model
 * @property Image[] $images
 */
class Car extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_DEACTIVE = 0;

    const OFFER_STATUS_ACTIVE = 10;
    const OFFER_STATUS_DEACTIVE = 0;

    private $upload_folder = 'uploads';

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
        return 'car';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['caption', 'status', 'offer_status', 'price1'], 'required'],
            [['status', 'offer_status', 'make_id', 'model_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['mileage', 'price1', 'price2'], 'number'],
            [['description'], 'string'],
            [['caption', 'engine', 'transmission', 'exterior_color', 'interior_color'], 'string', 'max' => 120],
            [['fuel', 'drive_train', 'vehicle_type'], 'string', 'max' => 45],
            [['make_id'], 'exist', 'skipOnError' => true, 'targetClass' => Make::className(), 'targetAttribute' => ['make_id' => 'id']],
            [['model_id'], 'exist', 'skipOnError' => true, 'targetClass' => Model::className(), 'targetAttribute' => ['model_id' => 'id']],
            [['thumbnail'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,gif,jpeg'],
            [['photos'], 'file',
                'skipOnEmpty' => true,
                'maxFiles' => 10,
                'extensions' => 'png,jpg,gif,jpeg'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'caption' => 'Caption',
            'status' => 'Status',
            'offer_status' => 'Offer Status',
            'make_id' => 'Make',
            'model_id' => 'Model',
            'mileage' => 'Mileage',
            'engine' => 'Engine',
            'transmission' => 'Transmission',
            'fuel' => 'Fuel',
            'drive_train' => 'Drive Train',
            'exterior_color' => 'Exterior Color',
            'interior_color' => 'Interior Color',
            'vehicle_type' => 'Vehicle Type',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'thumbnail' => 'Thumbnail',
            'price1' => 'Price1',
            'price2' => 'Price2',
            'photos' => 'Photos'
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['car_id' => 'id']);
    }

    public function uploadThumbnail($model, $attribute)
    {
        $thumbnail = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if($this->validate() && $thumbnail !== null) {
            $fileName = md5($thumbnail->baseName.time()) . '.' . $thumbnail->extension;

            if($thumbnail->saveAs($path . $fileName)){
                $oldFile = $this->getUploadPath() . $model->getOldAttribute($attribute);
                if(!$model->isNewRecord && is_file($oldFile))
                    unlink($oldFile);
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function uploadMultiple($model,$attribute)
    {
        $photos  = UploadedFile::getInstances($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && count($photos) > 0) {
            print_r($photos);
            $filenames = [];
            foreach ($photos as $file) {
                $filename = md5($file->baseName.time()) . '.' . $file->extension;
                if($file->saveAs($path . $filename)){
                    $filenames[] = $filename;

                }
            }
            $filesOld = @explode(',', $model->getOldAttribute($attribute));
            foreach($filesOld as $file){
                if(is_file($this->getUploadPath() . $file))
                    unlink($this->getUploadPath() . $file);
            }
            return implode(',',$filenames);
        }
        echo 'old : ' . $model->getOldAttribute($attribute) . '<br/>';

        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getPhotosViewer(){
        $photos = $this->photos ? @explode(',',$this->photos) : [];
        $img = '';
        foreach ($photos as  $photo) {
            $img.= ' '.Html::img($this->getUploadUrl().$photo,['alt' => 'EMPTY', 'class'=>'img-thumbnail','style'=>'max-width:100px;']);
        }
        return $img === '' ? '<span class="not-set">(not set)</span>' : $img;
    }

    public function getOwnPhotosToArray()
    {
        return $this->getOldAttribute('photos') ? @explode(',',$this->getOldAttribute('photos')) : [];
    }

    public function getUploadPath()
    {
        return Yii::getAlias('@webroot') . '/' . $this->upload_folder . '/';
    }

    public function getUploadUrl($app = '')
    {
        return Yii::getAlias('@web') . '/' . $app . $this->upload_folder . '/';
    }

    public function getPhotoViewer(array $options = ['width' => '250px', 'height' => 'auto', 'app' => ''])
    {
        return empty($this->thumbnail) ? '<span class="not-set">(not set)</span>' : Html::img($this->getUploadUrl($options['app']) . $this->thumbnail, ['alt' => 'EMPTY', 'class' => 'img-thumbnail',
            'style' => 'width: '.$options['width'].'; height: '.$options['height'].'; ']);
    }

    public static function getTypes($find)
    {
        return Car::find()->where(
            'status = :status AND (LCASE(transmission) = :t OR LCASE(fuel) = :f 
                OR LCASE(drive_train) = :d OR LCASE(vehicle_type) = :v)',
            [
                ':status' => Car::STATUS_ACTIVE,
                ':t' => strtolower($find),
                ':f' => strtolower($find),
                ':d' => strtolower($find),
                ':v' => strtolower($find),
            ]
        );
    }

    public static function d()
    {

    }
}
