<?php

namespace backend\controllers;

use Yii;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use common\models\Make;
use common\models\MakeSearch;
use common\models\MakeHasModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Car;

/**
 * MakeController implements the CRUD actions for Make model.
 */
class MakeController extends Controller
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
                    'delete-model' => ['POST']
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'update', 'delete', 'create', 'make-and-model', 'delete-model'],
                        'allow' => true,
                        'roles' => ['Admin']
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Make models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MakeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $carModel = Car::find()->all();
        $mmModel = MakeHasModel::find()->all();

        $makeIds = [];
        foreach($carModel as $car)
            if(!in_array($car->make_id, $makeIds))
                $makeIds[] = $car->make_id;
        foreach($mmModel as $mm){
            if(!in_array($mm->make_id, $makeIds))
                $makeIds[] = $mm->make_id;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'makeIds' => $makeIds
        ]);
    }

    /**
     * Displays a single Make model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $makeHasModel = MakeHasModel::find()->where(['make_id' => $id]);
        $mmDataProvider = new ActiveDataProvider([
            'query' => $makeHasModel
        ]);
        $queryModel = (new Query())
            ->select('id, name')
            ->from('model')
            ->leftJoin('make_has_model', 'id = model_id')
            ->where('model_id IS NULL')
            ->orderBy(['name' => SORT_ASC])
            ->all();
        $models = ArrayHelper::map($queryModel, 'id', 'name');
        return $this->render('view', [
            'model' => $this->findModel($id),
            'mmDataProvider' => $mmDataProvider,
            'models' => $models
        ]);
    }

    /**
     * Creates a new Make model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Make();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Make model.
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
     * Deletes an existing Make model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionMakeAndModel()
    {
        return $this->render('make-and-model');
    }

    public function actionDeleteModel($modelId, $makeId)
    {
        $model = MakeHasModel::find()
                ->where(['make_id' => $makeId, 'model_id' => $modelId])
                ->one();
        if(count($model) > 0)
            $model->delete();
        $this->redirect(Yii::getAlias('@web') . '/make/' . $makeId);
    }

    /**
     * Finds the Make model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Make the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Make::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
