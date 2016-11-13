<?php

namespace backend\controllers;

use common\models\CategoryHasSubCategory;
use common\models\SubCategory;
use Yii;
use common\models\Car;
use common\models\Image;
use common\models\Category;
use common\models\CarType;
use backend\models\CarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\db\Query;
use yii\widgets\DetailView;

/**
 * CarController implements the CRUD actions for Car model.
 */
class CarController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index', 'view', 'create', 'update', 'delete',
                            'get-sub-cat-by-cat', 'update-display-category',
                            'remove-category'
                        ],
                        'allow' => true,
                        'roles' => ['Admin'],
                    ],
                ]
            ]
        ];
    }

    /**
     * Lists all Car models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Car model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Car model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Car();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->thumbnail = $model->uploadThumbnail($model, 'thumbnail');
            $model->photos = $model->uploadMultiple($model, 'photos');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing Car model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->thumbnail = $model->uploadThumbnail($model, 'thumbnail');
            $model->photos = $model->uploadMultiple($model, 'photos');
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $cat = Category::find();
            $subcat = SubCategory::find();
            $cartype = CarType::find()
                ->where(['car_id' => $model->id]);
            return $this->render('update', [
                'model' => $model,
                'cat' => $cat,
                'subcat' => $subcat,
                'cartype' => $cartype
            ]);
        }
    }

    /**
     * Deletes an existing Car model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetSubCatByCat()
    {
        /* manual query...coding */
        if(Yii::$app->request->isPost){
            $model = (new Query())
                ->select('category_has_sub_category.category_id, category_has_sub_category.sub_category_id , sub_category.name')
                ->from('category_has_sub_category')
                ->join('LEFT JOIN', 'sub_category', 'sub_category_id=id')
                ->where('category_id = :id', [':id' => Yii::$app->request->post('id')])
                ->createCommand();
            echo Html::dropDownList('SubCategory[name]', null, ArrayHelper::map($model->queryAll(), 'sub_category_id', 'name'), [
                'prompt' => 'choose...', 'id' => 'sub-category_id'
            ]);
        }else{
            echo '';
        }
    }

    public function actionUpdateDisplayCategory()
    {
        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            $cartype = $this->findCategoryUpdate($data);
            if($cartype->count()==0){
                $cartype = new CarType();
                $cartype->category_id = $data['category_id'];
                $cartype->sub_category_id = $data['sub_category_id'];
                $cartype->car_id = $data['car_id'];
                if(!$cartype->save()) {
//                    print_r($cartype->errors);
//                    exit;
                }
                $catsubname = $cartype->getSubCategory()->where(['id' => $cartype->sub_category_id])->one()->name;
                $car = Car::findOne($cartype->car_id);
                if($cartype->category_id == 1){
                    $car->vehicle_type = $catsubname;
                }else if($cartype->category_id == 2){
                    $car->transmission = $catsubname;
                }else if($cartype->category->id == 3){
                    $car->drive_train = $catsubname;
                }else if($cartype->category->id == 4){
                    $car->fuel = $catsubname;
                }
                $car->save();
            }else{
                $cartype = $cartype->one();
                $cartype->sub_category_id = $data['sub_category_id'];
                $catsubname = $cartype->getSubCategory()->where(['id' => $cartype->sub_category_id])->one()->name;
                $car = Car::findOne($cartype->car_id);
                if($cartype->category_id == 1){
                    $car->vehicle_type = $catsubname;
                }else if($cartype->category_id == 2){
                    $car->transmission = $catsubname;
                }else if($cartype->category->id == 3){
                    $car->drive_train = $catsubname;
                }else if($cartype->category->id == 4){
                    $car->fuel = $catsubname;
                }
                $car->save();
                $cartype->save();
            }
            $cartype = CarType::find()
                ->where('car_id=:carid', [':carid' => $data['car_id']])
                ->orderBy(['category_id' => SORT_ASC]);
            echo $this->renderPartial('_category-detail', [
                'cartype' => $cartype
            ]);
        }else{
            echo '';
        }
    }

    public function actionRemoveCategory()
    {
        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            $model = CarType::find()
                ->where('car_id=:carid AND category_id=:catid AND sub_category_id=:subcatid', [
                    ':carid' => $data['car_id'],
                    ':catid' => $data['category_id'],
                    ':subcatid' => $data['sub_category_id']
                ])->one();
            $car = Car::findOne($model->car_id);
            if($model->category_id == 1){
                $car->vehicle_type = null;
            }else if($model->category_id == 2){
                $car->transmission = null;
            }else if($model->category->id == 3){
                $car->drive_train = null;
            }else if($model->category->id == 4){
                $car->fuel = null;
            }
            $car->save();
            $model->delete();
            $cartype = CarType::find()
                ->where('car_id=:carid', [':carid' => $data['car_id']])
                ->orderBy(['category_id' => SORT_ASC]);
            echo $this->renderPartial('_category-detail', [
                'cartype' => $cartype
            ]);
        }else{
            echo '';
        }
    }

    protected function findCategoryUpdate($data){
//        return (new Query())
//            ->select('category.name as catname, sub_category.name as subcatname')
//            ->from('car_type')
//            ->join('LEFT JOIN', 'category', ['car_type.category_id' => 'category.id'])
//            ->join('LEFT JOIN', 'sub_category', ['car_type.sub_category_id' => 'sub_category.id'])
//            ->where('category_id=:catid AND sub_category_id=:subcatid AND car_id=:carid', [
//                ':catid' => $data['category_id'],
//                ':subcatid' => $data['sub_category_id'],
//                ':carid' => $data['car_id']
//            ]);
        return CarType::find()
            ->where('category_id=:catid AND car_id=:carid' ,[
                ':catid' => $data['category_id'],
                ':carid' => $data['car_id']
            ])
            ->orderBy(['category_id' => SORT_ASC]);
    }

    /**
     * Finds the Car model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Car the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Car::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
