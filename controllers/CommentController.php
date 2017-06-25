<?php

namespace app\controllers;

use app\models\Comment;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;

class CommentController extends Controller {

    public function actionPlus() {

        if ($_POST['id']) {
            $id = $_POST['id'];

            $comment = Comment::findOne($id);
            $comment->updateCounters(['plus'=>1]);
            $count = $comment->plus;

            echo $count;

        }
    }

    public function actionMinus() {

        if ($_POST['id']) {

            $id = $_POST['id'];

            $comment = Comment::findOne($id);
            $comment->updateCounters(['plus'=>-1]);
            $count = $comment->plus;

            echo $count;
        }
    }

}