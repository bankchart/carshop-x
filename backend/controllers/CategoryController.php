<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
use common\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\CategoryHasSubCategory;
use common\models\CarType;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
                    'delete-sub-category' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [ 'index', 'view', 'create', 'update', 'delete', 'delete-sub-category' ],
                        'allow' => true,
                        'roles' => ['Admin']
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $carTypeModel = CarType::find()->all();
        $catsubModel = CategoryHasSubCategory::find()->all();

        $catIds = [];
        foreach($carTypeModel as $cartype)
            if(!in_array($cartype->category_id, $catIds))
                $catIds[] = $cartype->category_id;
        foreach($catsubModel as $catsub){
            if(!in_array($catsub->category_id, $catIds))
                $catIds[] = $catsub->category_id;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'catIds' => $catIds
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $catHasSubcat = CategoryHasSubCategory::find()->where(['make_id' => $id]);
        $cscDataProvider = new ActiveDataProvider([
            'query' => $catHasSubcat
        ]);
        $queryModel = (new Query())
            ->select('id, name')
            ->from('sub_category')
            ->leftJoin('category_has_sub_category', 'id = sub_category_id')
            ->where('sub_category_id IS NULL')
            ->orderBy(['name' => SORT_ASC])
            ->all();
        $models = ArrayHelper::map($queryModel, 'id', 'name');
        return $this->render('view', [
            'model' => $this->findModel($id),
            'cscDataProvider' => $cscDataProvider,
            'models' => $models
        ]);
        /*return $this->render('view', [
            'model' => $this->findModel($id),
        ]);*/
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteSubCategory($subcatId, $catId)
    {
        $model = CategoryHasSubCategory::find()
            ->where(['category_id' => $catId, 'sub_category_id' => $subcatId])
            ->one();
        if(count($model) > 0)
            $model->delete();
        $cartype = CarType::find()
            ->where('sub_category_id=:subcatid', [':subcatid' => $subcatId])->one();
        $cartype->delete();
        $this->redirect(Yii::getAlias('@web') . '/category/' . $catId);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
