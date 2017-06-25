<?php if (!empty($comments)):?>
    <h4>Comments:</h4>
    <?php foreach ($comments as $comment):?>

        <div class="media">
            <a class="pull-left" href="#">
                <img  width = '50' class="media-object" src="<?= $comment->user->image; ?>" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?= $comment->user->name; ?>
                    <small><?=$comment->getDate(); ?></small>
                </h4>
                <?= $comment->text; ?>
            </div>
            <?php if (!Yii::$app->user->isGuest):?>
            <div class="like" >

                <button class="btn btn-default pull-right plus"  type='button'  data-id = "<?=$comment->id; ?>">
                    <i class="glyphicon glyphicon-plus"></i>
                </button>
                <button class="btn btn-default pull-right minus"  type='button' data-id = "<?=$comment->id; ?>">
                    <i class="glyphicon glyphicon-minus"></i>
                </button>
                <div class=" pull-right" id="count<?=$comment->id ?>" style="padding: 5px; font-size: large"><?= $comment->plus; ?></div>
            </div>
            <?php endif;?>
        </div>
    <?php endforeach;?>
<?php endif;?>



    <hr>
<?php if (!Yii::$app->user->isGuest):?>
    <div class="leave-comment"><!--leave comment-->
        <h4>Leave a reply</h4>

<!--        --><?php //if (Yii::$app->session->getFlash('comment')):?>
<!--            <div class="alert alert-success" role="alert">-->
<!--                --><?//= Yii::$app->session->getFlash('comment'); ?>
<!--            </div>-->
<!--        --><?php //endif;?>

        <?php $form = \yii\widgets\ActiveForm::begin([
            'action'=>['site/comment', 'id'=>$article->id],
            'options'=>['class'=>'form-horizontal contact-form', 'role'=>'form']])?>

        <div class="form-group">
            <div class="col-md-12">
                <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control', 'placeholder'=>'Write Message'])->label(false)?>
            </div>
        </div>
        <button type="submit" class="btn send-btn">Post Comment</button>
        <?php \yii\widgets\ActiveForm::end()?>
    </div><!--end leave comment-->
<?php endif;?>