<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/avatar3.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Administrator</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?php
        /*
        echo dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Same tools',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'fa fa-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );
        */
        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Car settings', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Car',
                        'icon' => 'fa fa-car',
                        'url' => '#',
                        'items' => [
                            ['label' => 'list', 'icon' => 'fa fa-list', 'url' => ['/car'], 'active' => $this->context->route == 'car/index'],
                            ['label' => 'make and model', 'icon' => 'fa fa-flag', 'url' => ['/make-and-model'], 'active' => $this->context->route == 'make/index'],
                            [
                                'label' => 'category', 'icon' => 'fa fa-tags', 'url' => ['/category'],
                                'active' => @explode('/', $this->context->route)[0] == 'category' || @explode('/', $this->context->route)[0] == 'sub-category'
                            ],
                        ]
                    ],
                    ['label' => 'Page settings', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Page',
                        'icon' => 'fa fa-file-text',
                        'url' => '#',
                        'items' => [
                            ['label' => 'about / contact', 'icon' => 'fa fa-info', 'url' => ['/about-contact'], 'active' => $pageId == 'about-contact'],
                            ['label' => 'legal notice', 'icon' => 'fa fa-legal', 'url' => ['/legal-notice'], 'active' => $pageId == 'legal-notice'],
                            ['label' => 'terms and conditions', 'icon' => 'fa fa-filter', 'url' => ['/terms-and-conditions'], 'active' => $pageId == 'terms-and-conditions'],
                            ['label' => 'faq', 'icon' => 'fa fa-question', 'url' => ['/faq'], 'active' => $pageId == 'faq'],
                            ['label' => 'home slide', 'icon' => 'fa fa-file-image-o', 'url' => ['/home-slide'], 'active' => $pageId == 'home-slide'],
                        ]
                    ],
                //    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Social settings', 'options' => ['class' => 'header']],
                    ['label' => 'Social', 'icon' => 'fa fa-group', 'url' => ['/social']],
                    ['label' => 'Mail settings', 'options' => ['class' => 'header']],
                    ['label' => 'Mail', 'icon' => 'fa fa-envelope', 'url' => ['/mail-setting']],
                    [
                        'label' => 'Same tools',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'fa fa-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ); ?>

    </section>

</aside>
