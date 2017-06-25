<?php
use yii\helpers\Url;
?>

<div class="row">
    <?= $this->render('/partials/sidebar.php', [
        'rating' => $rating,
        'genres' => $genres,
    ]);?>
<div class="col-md-8">

    <!-- Blog Post -->

    <!-- Title -->
    <h1><?= $article->title; ?></h1>

<?php $analitic = false; ?>
    <ul>
        <?php foreach ($categories as $category):?>

        <li><a href="<?=Url::toRoute(['site/category', 'id'=>($category->id)]); ?>"><?=$category->title ?></a></li>
            <?php if ($category->title == 'Analitics') $analitic = true; ?>
        <?php endforeach;?>
    </ul>

    <!-- Author -->
    <p class="lead">
        by <a href="#"><?= $article->author->name;?></a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span>On <?= $article->getDate(); ?></p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" style="width: 500px" src="<?=$article->getImage(); ?>" alt="">

    <hr>
    <?php if (!(Yii::$app->user->isGuest)): ?>

        <p class="main-text"><?=$article->content; ?></p>
        <hr>
        <?php foreach ($tags as $tag):?>

            <button type="button" class="btn btn-outline-info"><a href="<?=Url::toRoute(['site/tag', 'title'=>strtolower($tag->title)]); ?>" ><?= $tag->title ?></a></button>

        <?php endforeach;?>
        <hr>

        <div>
            Now watching: <span id = "currentView"></span>
        </div>
        <div>
            All viewed: <span id="allView"></span>
        </div>
        <hr>

    <?php elseif ($analitic == false):?>
        <p class="main-text"><?=$article->content; ?></p>
        <hr>
        <?php foreach ($tags as $tag):?>

            <button type="button" class="btn btn-outline-info"><a href="<?=Url::toRoute(['site/tag', 'title'=>strtolower($tag->title)]); ?>" ><?= $tag->title ?></a></button>

        <?php endforeach;?>
        <hr>


    <?php else:?>
        <p class="main-text"><?php
            $content = $article->content;
            $content = substr($content, 0, 500);
            echo $content .'...';
            ?><br><small>For reading full article please <a href="<?=Url::toRoute(['auth/login']); ?>">login</a> or <a href="<?=Url::toRoute(['auth/signup']); ?>">register</a></small></p>

    <?php endif;?>

    <!-- Blog Comments -->



    <!-- Posted Comments -->

    <?= $this->render('/partials/comment', [
        'article'=>$article,
        'comments'=>$comments,
        'commentForm'=>$commentForm,
    ]);?>
</div>

<?= $this->render('/partials/sidebar.php', [
    'rating' => $rating,
    'genres' => $genres,
]);?>


</div>
<!-- /.row -->



