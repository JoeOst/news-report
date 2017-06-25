<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<div class="">
    <div class="row">


        <div class="col-lg-8">


            <h1><?= $user->name; ?></h1>

            <hr>


            <!-- List of all comments this user -->
            <h2>List of comments:</h2>
            <?php foreach ($comments as $comment):?>
                <!-- First Book Post -->
                <h3 class="article-name">
                    <a href="<?=Url::toRoute(['site/view', 'id'=>$comment->article->id]);?>"><?=$comment->text; ?></a>
                </h3>

                <a class="btn btn-primary" href="<?=Url::toRoute(['site/view', 'id'=>$comment->article->id]); ?>">Read <span class="glyphicon glyphicon-chevron-right"></span></a>

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
</div>
