<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\ChPwdForm;
use common\models\Car;
use common\models\Slides;
use common\models\User;
use frontend\models\SignupForm;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'signup', 'error', 'recover-password'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'change-password', 'home-slide', 'caption', 'mail-setting', 'test'],
                        'allow' => true,
                        'roles' => ['Admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'signup' => ['post']
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //return $this->render('index');
        return $this->redirect(['/car']);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $userCount = User::find()->count();
            if($userCount > 0) {
                return $this->render('login', [
                    'model' => $model,
                ]);
            }else {
                $model = new SignupForm();
                return $this->render('register', [
                    'model' => $model
                ]);
            }
        }
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $auth = Yii::$app->authManager;
                $admin = $auth->getRole('Admin');
                $auth->assign($admin, $user->id);
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionChangePassword()
    {
        $model = new ChPwdForm();
        if(Yii::$app->request->isPost){
            $result = $model->load(Yii::$app->request->post()) && $model->update() ?
                [
                    'body' => 'Change password : success',
                    'options' => ['class' => 'alert alert-success']
                ] :
                [
                    'body' => 'Change password : fail',
                    'options' => ['class' => 'alert alert-danger']
                ];
            Yii::$app->getSession()->setFlash('alert', $result);
        }

        return $this->render('change-password', [
            'model' => $model
        ]);
    }

    public function actionHomeSlide()
    {
        if(Yii::$app->request->isPost && Yii::$app->request->post('id') !== null){
            $model = Slides::find()
                ->where(['id' => Yii::$app->request->post('id')])
                ->one();
            $model->car_id = -1;
            $model->photo = '';
            $model->save();
        }

        if(Yii::$app->request->isPost && Yii::$app->request->post('id-src') !== null && Yii::$app->request->post('slide-no') > 0){
           $data = Yii::$app->request->post();
            $slideId = $data['slide-no'];
            $idsrc = explode('-', $data['id-src']);
            if($data['id-src'] == '') return $this->redirect('home-slide');
            $carId = $idsrc[0];
            $src = str_replace('/backend/uploads/', '', $idsrc[1]);
            $model = Slides::find()
                ->where(['id' => $slideId])
                ->one();
            $model->car_id = $carId;
            $model->photo = $src;
            $model->save();
        }

        /* GridView config */
        $carModel = Car::find()
            ->join('LEFT JOIN', 'slides', 'car.id=slides.car_id')
            ->where(
                'status=:status AND slides.car_id IS NULL',
                [':status' => Car::STATUS_ACTIVE]
            );
        $dataProvider = new ActiveDataProvider([
            'query' => $carModel,
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'attributes' => ['caption']
            ]
        ]);
        if($carModel->count() > 0) {
            $model = new Car();
            $model->load(Yii::$app->request->queryParams);
            $carModel->andFilterWhere([
                'id' => $model->id,
                'status' => $model->status,
                'offer_status' => $model->offer_status,
                'make_id' => $model->make_id,
                'model_id' => $model->model_id,
                'mileage' => $model->mileage,
            ]);
            $carModel->andFilterWhere(['like', 'caption', $model->caption]);
        }
        /* end. GridView config */

        $slideModel = Slides::find();
        return $this->render('home-slide', [
            'dataProvider' => $dataProvider,
            'carModel' => $carModel,
            'model' => $model,
            'slideModel' => $slideModel,
        ]);
    }

    public function actionCaption($no=-1)
    {
        $model = Slides::findOne($no);
        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            $result = $model->save();
            Yii::$app->getSession()->setFlash('alert', [
                'body' => $result ? 'Success' : 'Failure : ' . print_r($model->errors, true),
                'options' => ['class' => $result ? 'alert-success' : 'alert-danger']
            ]);
        }
        return $this->render('_caption-slide', ['model' => $model]);
    }

    public function actionMailSetting()
    {
        $model = User::findOne(Yii::$app->user->id);
        if(Yii::$app->request->isPost) {
            $model->email = Yii::$app->request->post('User')['email'];
            if($model->save()) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => 'Success',
                    'options' => ['class' => 'alert-success']
                ]);
            }else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => 'Failure',
                    'options' => ['class' => 'alert-danger']
                ]);
            }
        }
        return $this->render('mail-setting', [
            'model' => $model
        ]);
    }

    public function actionRecoverPassword()
    {
        if(Yii::$app->request->isPost){
            $model = User::find()->one();
            $email = Yii::$app->request->post('email');
            if($email == $model->email){
                $data = Yii::$app->request->post();
                $from = $model->email;
                $name = 'Carshop-X';
                $subject = 'Recover Password';
                $new_password = Yii::$app->security->generateRandomString(8);
                $message = 'this your new passowrd : ' . $new_password;
                $model->setPassword($new_password);
                $model->save();
                Yii::$app->mailer->compose('@app/mail/layouts/recover', [
                    'message' => $message
                ])
                    ->setFrom([$from => $name])
                    ->setTo($model->email)
                    ->setSubject($subject)
                    ->send();
                echo 'success';
            }else{
                echo 'fail';
            }
        }
    }

    public function actionTest()
    {
        for($i=0;false;$i++) {
            $model = new Slides();
            $model->car_id = ($i+1);
            $model->photo = '---';
            $model->caption = 'fucking - ' . ($i+1);
            $model->save();
        }
    }
}
