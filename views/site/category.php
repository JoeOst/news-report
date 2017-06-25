<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<div class="row">


    <div class="col-lg-8">


        <h1><?= $category->title; ?></h1>

        <hr>


        <!-- List of all post this category -->
        <h2>List of all articles:</h2>
        <?php foreach ($articles as $article):?>
                <!-- First Book Post -->
                <h2 class="article-name">
                    <a href="<?=Url::toRoute(['site/view', 'id'=>$article->id]);?>"><?=$article->title; ?></a>
                </h2>

                <a class="btn btn-primary" href="<?=Url::toRoute(['site/view', 'id'=>$article->id]); ?>">Read <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
        <?php endforeach;?>


        <?php
        echo LinkPager::widget([
            'pagination' => $pagination,
        ]);
        ?>


    </div>



    <!-- Blog Sidebar Widgets Column -->
    <?= $this->render('/partials/sidebar.php', [
        'rating' => $rating,
        'genres' => $genres,
    ]);?>

</div>
<!-- /.row -->
