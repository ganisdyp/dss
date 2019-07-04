<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>{User Name}</p>

                <a href="#"><i class="fa fa-circle text-success"></i> {Plant Info}</a>
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
                    [
                        'label' => 'Daily Sales Summary',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Today Sales', 'icon' => 'sale', 'url' => ['/salerecord/index'],],

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
