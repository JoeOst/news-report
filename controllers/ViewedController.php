<?php
namespace app\controllers;

use app\models\Article;
use app\models\Comment;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;

class ViewedController extends Controller
{
    public function actionIndex() {
        if ($_POST) {
            $currentView = $_POST['view'];
            $id = $_POST['id'];
            $arr = explode('=',$id);
            $id = $arr[1];
            $article = Article::findOne($id);
            $article->viewed += $currentView;
            $article->save();
            $data['par1'] = $currentView;
            $data['par2'] = $article->viewed;

           echo json_encode($data);
        }

    }
}