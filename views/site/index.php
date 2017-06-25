<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<div class="row">
    <!-- Blog Sidebar Widgets Column -->
    <?= $this->render('/partials/sidebar.php', [
        'rating' => $rating,
        'genres' => $genres,
    ]);?>

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <div class="clearfix">
            <div id="slider-wrap">
                <div id="slider">
                    <?php foreach ($recent as $article): ?>

                        <div class="slide"><h2 style="text-align: center"><a href="<?=Url::toRoute(['site/view', 'id'=>$article->id]); ?>"><?=$article->title; ?></a></h2><img src="<?=$article->getImage(); ?>" width="640" height="360"></div>
                    <?php endforeach;?>

                </div>
            </div>

            <div class="">
                <h1 class="page-header">
                    Articles
                    <small>Secondary Text</small>
                </h1>

                <?php foreach ($categories as $category):?>
                    <!-- First Category -->
                    <div class="col-md-4">
                        <h2><a href="<?=Url::toRoute(['site/category', 'id'=>$category->id]);?>"><?= $category->title; ?></a></h2>
                        <?php foreach (($category->getLastArticlesByCategory($category->id)) as $article): ?>

                            <h3><?= $article->title; ?></h3>

                            <p><a class="btn btn-secondary" href="<?=Url::toRoute(['site/view', 'id'=>$article->id]); ?>" role="button">View details &raquo;</a></p>
                        <?php endforeach; ?>
                    </div>

                <?php endforeach; ?>
            </div>

        </div>


        <hr>


        <div class="" style="">
            <h3>Top-5 commentators</h3>
            <ol>
                <?php foreach ($commentators as $commentator): ?>
                    <li><a href="<?=Url::toRoute(['site/user', 'id'=>$commentator->id]); ?>"><?= $commentator->name;?></a></li>
                <?php endforeach;?>
            </ol>
        </div>

        <div>
            <h3>Popular Article</h3>
            <ol>
                <?php foreach ($popular as $article): ?>
                    <li><a href="<?=Url::toRoute(['site/view', 'id'=>$article->id]); ?>"><?= $article->title;?></a></li>
                <?php endforeach;?>
            </ol>
        </div>



    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?= $this->render('/partials/sidebar.php', [
        'rating' => $rating,
        'genres' => $genres,
    ]);?>
</div>
<!-- /.row -->

