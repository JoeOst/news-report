<?php

namespace app\controllers;

use app\models\Article;
use app\models\Category;
use app\models\CommentForm;
use app\models\Tag;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Response;
use yii\web\View;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       $categories = Category::getAll();


       $popular = Article::getPopular();
      // print_r($popular); die;

        $recent = Article::getRecent();

       // print_r($commentators = User::getUserByCommentsCount()); die;
        $commentators = User::getUserByCommentsCount();

        return $this->render('index', [
          'popular' => $popular,
            'recent' => $recent,
            'categories' => $categories,
            'commentators' => $commentators,

        ]);
    }

    public function actionView($id) {

        $article = Article::findOne($id);
//        $popular = Article::getPopular();
//        $recent = Article::getRecent();
        //$categories = Category::getAll();
        $comments = $article->getArticleComments();
        $commentForm = new CommentForm();

        $tags = $article->getSelectedTagsForCurrentArticle();
        $categories = $article->getSelectedCategoriesForCurrentArticles();

//        $article->viewedCounter();


        return $this->render('single',[
            'article' => $article,
//            'popular' => $popular,
//            'recent' => $recent,
            'categories' => $categories,
            'comments' => $comments,
            'commentForm' => $commentForm,
            'tags' => $tags,

        ]);
    }

    public function actionCategory($id) {
        $data = Category::getArticlesByCategory($id);

       // $popular = Article::getPopular();

       // $recent = Article::getRecent();

//        $categories = Category::getAll();

        return $this->render('category',[
            'articles'=>$data['articles'],
            'pagination'=>$data['pagination'],
//            'popular' => $popular,
//            'recent' => $recent,
//            'categories' => $categories,
        ]);
    }



    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionComment($id) {
        $model = new CommentForm();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            if ($model->saveComment($id)) {
                Yii::$app->getSession()->setFlash('comment', 'Your comment will be added soon!');
                return $this->redirect(['site/view', 'id' => $id]);
            }
        }
    }

    public function actionTag($title)
    {
        $currentTag = Tag::getCurrentTag($title);

       $id = $currentTag->id;
        $data = Tag::getArticlesByTag($id);

        return $this->render('tag', [
            'articles'=>$data['articles'],
            'pagination'=>$data['pagination'],

            'currentTag'=>$currentTag,
        ]);
    }

    public function actionUser($id) {

        $user = User::findOne($id);

        $data = $user->getAllCommentsByUser();

        return $this->render('user', [
            'comments'=>$data['comments'],
            'pagination'=>$data['pagination'],

            'user'=>$user,
        ]);
    }

    public function actionTest() {
        $categories = Category::getAll();

       $c = ArrayHelper::map($categories, 'id' ,'title');
       //var_dump($c); die;
        $articles = [];
        foreach ($c as $k=>$v) {
            $articles[$k][$v] = Category::getArticlesListByCategory($k);
        }
        print_r($articles);


    }

}
