<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

use common\models\User;
use common\models\Content;
use common\models\Car;
use common\models\Faq;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    /*[
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],*/
                    /*[
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],*/
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($p=1)
    {
        $itemPerPage = 4;
        $model = Car::find()->where(['status' => Car::STATUS_ACTIVE]);
        $total = $model->count();
        $totalPage = $total > $itemPerPage ? ceil($total / $itemPerPage) : 1;
        $pages = [];
        if ($p <= $totalPage && $p > 0) for ($i = 1; $i <= $totalPage; $i++) $pages[$i-1] = $p==$i ? 'active' : '';
        else $pages[0] = 'active';
        $model->offset(($p - 1) * $itemPerPage)->limit($itemPerPage)->orderBy(['updated_at' => SORT_DESC]);
        return $this->render('index', [
            'paginationModel' => $total > 0 ? $model->all() : null,
            'pages' => $pages,
            'p' => $p,
            'totalPage' => $totalPage
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    /*public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionAboutAndContact()
    {
        $about = Content::find()
                    ->where(['mark' => 'about'])
                    ->one();
        $contact = Content::find()
                    ->where(['mark' => 'contact'])
                    ->one();
        return $this->render('about-and-contact', [
            'about' => $about,
            'contact' => $contact
        ]);
    }

    public function actionLegalNotice()
    {
        $model = Content::find()
                ->where(['mark' => 'legal notice'])
                ->one();
        return $this->render('legal-notice', [
            'model' => $model
        ]);
    }

    public function actionTermsAndConditions()
    {
        $model = Content::find()
        ->where(['mark' => 'terms and conditions'])
        ->one();
        return $this->render('terms-and-conditions', [
            'model' => $model
        ]);
    }

    public function actionFaq()
    {
        $model = Faq::find();
        return $this->render('faq', [
            'model' => $model
        ]);
    }

    public function actionCarDetail($id)
    {
        $carModel = Car::findOne($id);
        return $this->render('car-detail', [
            'carModel' => $carModel
        ]);
    }

    public function actionCarList($p=1)
    {
        $itemPerPage = 6;
        $params = array_values(Yii::$app->request->queryParams);
        $keys = array_keys(Yii::$app->request->queryParams);
        if(Yii::$app->request->get('srch-text')) {
            $find = Yii::$app->request->get('srch-text');
            $model = Car::find()
                        ->where(
                            "status = :status AND (engine LIKE '%$find%' OR transmission LIKE '%$find%' OR 
                            fuel LIKE '%$find%' OR drive_train LIKE '%$find%' OR exterior_color LIKE '%$find%' OR 
                            interior_color LIKE '%$find%' OR vehicle_type LIKE '%$find%' OR description LIKE '%$find%')",
                            [':status' => Car::STATUS_ACTIVE]
                        );
        }else{
            $model = Car::getTypes($params[0]);
        }

        /* search key for offer or new car */

        $total = $model->count();
        $model->offset(($p - 1) * $itemPerPage)->limit($itemPerPage)->orderBy(['updated_at' => SORT_DESC]);
        $totalPage = $total > $itemPerPage ? ceil($total / $itemPerPage) : 1;
        $pages = [];
        if ($p <= $totalPage) for ($i = 1; $i <= $totalPage; $i++) $pages[$i-1] = $p==$i ? 'active' : '';
        else $pages[0] = 'active';
        return $this->render('car-list', [
            'model' => $total > 0 ? $model->all() : null,
            'pages' => $pages,
            'search' => $params[0],
            'keySearch' => $keys[0],
            'p' => $p,
            'totalPage' => $totalPage
        ]);
    }

    public function actionSpecialOffer($p=1)
    {
        $itemPerPage = 6;
        $model = Car::find()
                ->where(['status' => Car::STATUS_ACTIVE, 'offer_status' => Car::OFFER_STATUS_ACTIVE])
                ->orderBy(['updated_at' => SORT_DESC]);
        $total = $model->count();
        $model->offset(($p - 1) * $itemPerPage)->limit($itemPerPage);
        $totalPage = $total > $itemPerPage ? ceil($total / $itemPerPage) : 1;
        $pages = [];
        if ($p <= $totalPage) for ($i = 1; $i <= $totalPage; $i++) $pages[$i-1] = $p==$i ? 'active' : '';
        else $pages[0] = 'active';
        return $this->render('_special-and-newcar', [
            'model' => $total > 0 ? $model->all() : null,
            'pages' => $pages,
            'p' => $p,
            'totalPage' => $totalPage,
            'title' => 'Special Offer'
        ]);
    }

    public function actionNewCar($p=1)
    {
        $itemPerPage = 6;
        $newcars = $this->checkNewCar();
        $model = Car::find()
            ->where([
                'status' => Car::STATUS_ACTIVE,
                'id' => $newcars
            ])
            ->orderBy(['created_at' => SORT_DESC]);
        $total = $model->count();
        $model->offset(($p - 1) * $itemPerPage)->limit($itemPerPage);
        $totalPage = $total > $itemPerPage ? ceil($total / $itemPerPage) : 1;
        $pages = [];
        if ($p <= $totalPage) for ($i = 1; $i <= $totalPage; $i++) $pages[$i-1] = $p==$i ? 'active' : '';
        else $pages[0] = 'active';
        return $this->render('_special-and-newcar', [
            'model' => $total > 0 ? $model->all() : null,
            'pages' => $pages,
            'p' => $p,
            'totalPage' => $totalPage,
            'title' => 'Newcar'
        ]);
    }

    public function actionMail()
    {
        if(Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $user = User::find()->one();
//            echo $user->email;
//            exit;
            $from = $data['email'];
            $name = $data['name'];
            $subject = $data['subject'];
            $message = $data['message'];
            echo 'waiting...';
            Yii::$app->mailer->compose('@app/mail/layouts/contact', [
                'message' => $message
            ])
                ->setFrom([$from => $name])
                ->setTo($user->email)
                ->setSubject($subject)
                ->send();
            return $this->redirect('/');
        }
    }

    private function checkNewCar()
    {
        $model = Car::find()
            ->where(['status' => Car::STATUS_ACTIVE]);
        $newcars = [];
        foreach($model->all() as $car){
            $inputSeconds = $car->created_at;
            $then = new \DateTime(date('Y-m-d', $inputSeconds));
            $now = new \DateTime(date('Y-m-d', time()));
            $diff = $then->diff($now);
            if($diff->m == 0)
                $newcars[] = $car->id;
        }
        return $newcars;
    }

    public function actionTest()
    {
        $query = Car::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3
            ]
        ]);
        return $this->render('test', [
            'dataProvider' => $dataProvider
        ]);
    }
}
