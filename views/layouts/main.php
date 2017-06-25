<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\PublicAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

PublicAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Start Bootstrap</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav dropdown_menu"  >
                <li>
                    <a href="<?=Url::toRoute(['/'])?>">Home</a>
                </li>
                <li><a href="#">Category</a>
                    <ul>
                       <?php
                       $menu = \app\models\Category::dropDownMenu();
                       foreach ($menu['articles'] as $key => $article) :?>
                        <li><a href="<?=Url::toRoute(['site/category', 'id'=>($menu['key'][$key])]); ?>"><?=$key?></a>
                            <ul>

                                <?php foreach ($article as $k => $item) :?>
                                <li><a href="<?=Url::toRoute(['site/view', 'id'=>$k]); ?>"><?=$item?></a></li>

                                <?php endforeach;?>
                            </ul>
                        </li>
                       <?php endforeach;?>
                       </ul>
                </li>


            </ul>

            <?php if (Yii::$app->user->isGuest): ?>
                <a href="<?=Url::toRoute(['auth/login']); ?>" class="btn btn-success navbar-btn navbar-right">Login</a>
                            <a href="<?=Url::toRoute(['auth/signup']); ?>" class="btn btn-success navbar-btn navbar-right">Register</a>
            <?php else: ?>
                <?=Html::beginForm(['/auth/logout'], 'post')
                .Html::submitButton(
                    'Logout ('.Yii::$app->user->identity->name . ')',
                    ['class' => 'btn btn-success navbar-btn navbar-right', 'style' => 'margin-left: 10px;']
                )
                .Html::endForm()?>
            <?php endif;?>


            <form class="navbar-form navbar-right" method="get" id="form">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search tags" id = "search">
                    <div class="input-group-btn">
                        <button class="btn btn-default"  type="submit" id="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>


        </div>
        <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">

<?= $content; ?>

<hr>

<!-- Footer -->
<footer>
    <div class="row">
        <div class="col-lg-12">
            <p>Copyright &copy; Your Website 2017</p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</footer>

</div>
<!-- /.container -->


<div class="popup_overlay"></div>
<div class="popup">
    <div class="popup_title">
        Subscribe for us <span class="closer">X</span>
    </div>
    <div class="popup_content">
        <form>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your name">
            </div>
            <div class="form-group">
                <label for="surname">Surname:</label>
                <input type="text" class="form-control" id="surname" placeholder="Enter your surname">
            </div>
            <button type="submit" class="btn btn-primary">Subscribe</button>
        </form>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



