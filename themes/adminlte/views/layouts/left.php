<?php
use app\models\Profile;
if(Yii::$app->user->isGuest){
    $user_name = 'NO INFORMATION';
    $user_plant = 'NO INFORMATION';
    $date = "NO INFORMATION";
}else{
    $user_name = Profile::findByUserId(Yii::$app->user->identity->getId())->Name;
    $user_plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant->id;
    $user_plant = Profile::findByUserId(Yii::$app->user->identity->getId())->plant->name;
    $date = date('M.Y', Yii::$app->user->identity->getCreatedAt());

    $default_filter = 'plant_id='.$user_plant_id.'&filter='.date('Y-M');
    $default_filter_monthly_report = 'plant_id=0&filter='.date('Y-M');
    $default_filter_driver_report = 'plant_id=0&driver_id=9999&filter='.date('Y-M');
    if($user_plant_id == 0){
        $default_filter_daily_salerecord = 'plant_id=0&date='.date('Y-m-d');
    }else{
        $default_filter_daily_salerecord = 'date='.date('Y-m-d');
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
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu DSS', 'options' => ['class' => 'header']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site/dashboard?'.$default_filter]],
                    ['label' => 'Driver Trip Report', 'icon' => 'user', 'url' => ['/site/driver?'.$default_filter_driver_report]],
                    ['label' => 'Monthly Report', 'icon' => 'file-o', 'url' => ['/site/report?'.$default_filter_monthly_report]],
                    [
                        'label' => 'Daily Sales Summary',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Today Sales', 'icon' => 'sale', 'url' => ['/salerecord/index?'.$default_filter_daily_salerecord],],

                        ],
                    ],
                    ['label' => 'Customer', 'icon' => 'group', 'url' => ['/customer/index']],
                    [
                        'label' => 'Data Setup',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Plant', 'icon' => 'industry', 'url' => ['/plant/index'],],
                            ['label' => 'Location', 'icon' => 'map', 'url' => ['/location/index'],],
                            ['label' => 'Driver', 'icon' => 'user', 'url' => ['/driver/index'],],
                            ['label' => 'Grade', 'icon' => 'copyright', 'url' => ['/grade/index'],],

                        ],
                    ],
                    [
                        'label' => 'Truck',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Truck', 'icon' => 'truck', 'url' => ['/truck/index'],],
                            ['label' => 'Truck expense', 'icon' => 'file', 'url' => ['/truckexpense/index'],],
                        ],
                    ],
                    ['label' => 'User Management', 'icon' => 'group', 'url' => ['/profile/index']],
                ],
            ]
        ) ?>

    </section>

</aside>
