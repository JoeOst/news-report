<?php
namespace app\controllers;

use app\models\Tag;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\View;

class SearchController extends Controller {

    public function actionTag() {

        //header('Content-Type: application/json; charset=utf-8');

        function searchAutocomplete(){

            $search = Yii::$app->request->get('term');
           // $search = 't';

            $query = Tag::find()->where(['like', 'title', $search])->limit(10)->asArray()->all();

            $tag = ArrayHelper::getColumn($query, 'title');

           // var_dump($tag); die();


            $result_search = array();

            foreach ($query as $q) {
                $result_search[] = array('label' => $q['title']);
            }

           //print_r( $result_search); die();
            return $result_search;
        }

       if(!empty($_GET['term'])){
            $search = searchAutocomplete();
            exit( Json::encode($search) );
        }

//
//
//        $tags = Tag::getAll();
//
//        $tags = ArrayHelper::getColumn($tags, 'title');
//
//        $tags = Json::encode($tags);
//
//
//        echo $tags;
    }
}