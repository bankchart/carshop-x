<?php
use yii\helpers\Html;
use common\models\User;

/* @var $this \yii\web\View */
/* @var $content string */

$userCount = User::find()->count();
//die('count : ' . $userCount);
if($userCount < 1){
    // coding register form -> first setting system.
    echo $this->render('main-register', [
        'content' => $content
    ]);
}else if (Yii::$app->controller->action->id === 'login') {
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?= Yii::$app->request->baseUrl ?>/favicon.ico" rel="shortcut icon">
        <?= Html::csrfMetaTags() ?>
        <?php $this->title = 'CARSHOP'; ?>
        <title><?= Html::encode($this->title) ?></title>
        <script type="text/javascript">
            var baseUrl = '<?= Yii::$app->urlManager->createAbsoluteUrl(['/']) ?>';
        </script>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>
        <?php
            $parseUrl = explode('/', Yii::$app->request->url);
            $pageId = null;
            if(count($parseUrl) > 0)
                $pageId = $parseUrl[count($parseUrl) - 1];
        ?>
        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset, 'pageId' => $pageId]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
