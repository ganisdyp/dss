<?php
use yii\helpers\Html;
use app\models\Profile;
/* @var $this \yii\web\View */
/* @var $content string */
if(Yii::$app->user->isGuest){
    $user_name = 'NO INFORMATION';
    $user_plant = 'NO INFORMATION';
    $date = "NO INFORMATION";
}else{
    $user_name = Profile::findByUserId(Yii::$app->user->identity->getId())->Name;
    $user_plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant->id;
    $user_plant = Profile::findByUserId(Yii::$app->user->identity->getId())->plant->name;
    $date = date('M.Y', Yii::$app->user->identity->getCreatedAt());
}

$default_date = date('Y-M');
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">DSS</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->

                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php echo $user_name;?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?php echo $user_name." - ".strtoupper($user_plant); ?>
                                <small>Member
                                    since <?= $date ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">

                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
            </ul>
        </div>
    </nav>
</header>
