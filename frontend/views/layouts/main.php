<?php

/* @var $this \yii\web\View */
/* @var $content string */

use Yii;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$cartItemCount = $this->params['cartItemCount'];

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-expand-lg navbar-dark bg-dark fixed-top',
            ],
        ]);
        $menuItems = [
            [
                'label' => 'Cart <span id="cart-quantity" class="badge badge-danger">' . $cartItemCount . '</span>',
                'url' => ['/cart/index'],
                'encode' => false
            ],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = [
                'label' => Yii::$app->user->identity->getDisplayName(),
                //            'dropDownOptions' => [
                //                'class' => 'dropdown-menu-right'
                //            ],
                'items' => [
                    [
                        'label' => 'Profile',
                        'url' => ['/profile/index'],
                    ],
                    [
                        'label' => 'Logout',
                        'url' => ['/site/logout'],
                        'linkOptions' => [
                            'data-method' => 'post'
                        ],
                    ]
                ]
            ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ml-auto'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>

        <div class="container" style="margin-top: 80px;">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer mt-5">
        <div class="container">
            <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
