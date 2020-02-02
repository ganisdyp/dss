<?php
use app\models\Profile;

if (Yii::$app->user->isGuest) {
    $user_name = 'NO INFORMATION';
    $user_plant = 'NO INFORMATION';
    $date = "NO INFORMATION";
} else {
    $user_role = Yii::$app->user->identity->getRole();

    $user_name = Profile::findByUserId(Yii::$app->user->identity->getId())->Name;
    $user_plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant->id;
    $user_plant = Profile::findByUserId(Yii::$app->user->identity->getId())->plant->name;
    $date = date('M.Y', Yii::$app->user->identity->getCreatedAt());

    $default_filter = 'plant_id=' . $user_plant_id . '&filter=' . date('Y-M');
    $default_filter_m = 'filter=' . date('Y-M');
    $default_filter_monthly_report = 'plant_id=0&filter=' . date('Y-M');
    $default_monthly_report = 'month=' . date('Y-M');
    $default_filter_driver_report = 'plant_id=0&driver_id=0&filter=' . date('Y-M');
    $default_filter_truckexpense_report = 'truck_id=0&month=' . date('Y-M');
    if ($user_plant_id == 0) {
        $default_filter_daily_salerecord = 'plant_id=0&date=' . date('Y-m-d');
    } else {
        $default_filter_daily_salerecord = 'date=' . date('Y-m-d');
    }

}

function isPlantUser($user_role)
{
    if ($user_role == 1) {
        return true;
    } else {
        return false;
    }
}

function isMMUser($user_role)
{
    if ($user_role == 9) {
        return true;
    } else {
        return false;
    }
}

function isHQUser($user_role)
{
    if ($user_role == 5) {
        return true;
    } else {
        return false;
    }
}
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= strtoupper($user_name) ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> <?= strtoupper($user_plant) ?></a>
            </div>
        </div>

        <!-- search form
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        -->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site/dashboard?' . $default_filter]],
                    ['label' => 'Material Audit Summary', 'options' => ['class' => 'header'],'visible'=>isMMUser($user_role)],
                    ['label' => 'Daily Report', 'icon' => 'file-o', 'url' => ['/site/materialaudit?' . $default_filter],'visible'=>isMMUser($user_role)],
                    ['label' => 'Monthly Report', 'icon' => 'file-o', 'url' => ['/site/materialauditm?' . $default_filter_m],'visible'=>isMMUser($user_role)],

                    ['label' => 'Sales Summary', 'options' => ['class' => 'header']],

                    [
                        'label' => 'Daily Sales Key in',
                        'icon' => 'edit',
                        'url' => ['/salerecord/index?' . $default_filter_daily_salerecord]

                    ],
                    ['label' => 'Monthly Report', 'icon' => 'file-o', 'url' => ['/site/report?' . $default_filter_monthly_report],'visible'=>(isMMUser($user_role) || isHQUser($user_role))],
                    ['label' => 'Monthly Report (CS)', 'icon' => 'file-o', 'url' => ['/site/reportcs?' . $default_filter_monthly_report],'visible'=>(isMMUser($user_role) || isHQUser($user_role))],
                    ['label' => 'Truck Summary', 'options' => ['class' => 'header'], 'visible'=>isMMUser($user_role)],
                    [
                        'label' => 'Monthly Expense Key in',
                        'icon' => 'edit',
                        'url' => ['/truckexpense/index?' . $default_filter_truckexpense_report],
                        'visible'=>isMMUser($user_role)

                    ],
                    ['label' => 'Monthly Report', 'icon' => 'file-o', 'url' => ['/truckexpense/report?' . $default_monthly_report],'visible'=>isMMUser($user_role)],
                    ['label' => 'Driver', 'options' => ['class' => 'header'],'visible'=>(isMMUser($user_role) || isHQUser($user_role))],
                    ['label' => 'Driver Trip', 'icon' => 'user-o', 'url' => ['/site/driver?' . $default_filter_driver_report],'visible'=>(isMMUser($user_role) || isHQUser($user_role))],



                    ['label' => 'Configurations', 'options' => ['class' => 'header']],

                    ['label' => 'User Management', 'icon' => 'group', 'url' => ['/profile/index'],'visible'=>isMMUser($user_role)],
                    ['label' => 'Customer-Project', 'icon' => 'group', 'url' => ['/custprojrel/index']],
                    ['label' => 'Project-Location', 'icon' => 'map', 'url' => ['/projlocarel/index']],
                    [
                        'label' => 'Data Setup',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Plant', 'icon' => 'industry', 'url' => ['/plant/index'],'visible'=>isMMUser($user_role)],
                            ['label' => 'Customer', 'icon' => 'user', 'url' => ['/customer/index']],
                            ['label' => 'Project', 'icon' => 'file', 'url' => ['/project/index']],
                            ['label' => 'Location', 'icon' => 'map', 'url' => ['/location/index'],],
                            ['label' => 'Truck', 'icon' => 'truck', 'url' => ['/truck/index'],],
                            ['label' => 'Driver', 'icon' => 'user-o', 'url' => ['/driver/index'],],
                            ['label' => 'Grade', 'icon' => 'copyright', 'url' => ['/grade/index'],],


                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
