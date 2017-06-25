<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['id' => 'article_id'])
            ->viaTable('article_category', ['category_id' => 'id']);
    }

    public function getArticlesCount() {

        return $this->getArticles()->count();
    }

    public static function getAll() {

        return Category::find()->orderBy('title')->all();
    }

    public static function getArticlesByCategory($id) {
        // build a DB query to get all articles
        $query = Article::find()->innerJoin('article_category', '`article_category`.`article_id` = `article`.`id`')->innerJoin('category', '`article_category`.`category_id` = `category`.`id`')->where(['category_id'=> $id]);

        // get the total number of articles (but do not fetch the article data yet)
        $count = $query->count();

        // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);

        // limit the query using the pagination and retrieve the articles
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['articles'] = $articles;
        $data['pagination'] = $pagination;

        return $data;
    }

    public static function getLastArticlesByCategory($id) {
        $query = Article::find()->innerJoin('article_category', '`article_category`.`article_id` = `article`.`id`')->innerJoin('category', '`article_category`.`category_id` = `category`.`id`')->where(['category_id'=> $id]);

       return $query->orderBy('date desc')->limit(5)->all();

    }

    public static function dropDownMenu() {
        $categories = Category::getAll();

        $c = ArrayHelper::map($categories, 'id' ,'title');
        //var_dump($c); die;
        $articles = [];
        $key = [];
        foreach ($c as $k=>$v) {
            $articles[$v] = Category::getArticlesListByCategory($k);
            $key[$v] = $k;
        }

        $data['articles'] = $articles;
        $data['key'] = $key;
        return $data;

    }

    public static function getArticlesListByCategory($id) {

        $query = Article::find()->innerJoin('article_category', '`article_category`.`article_id` = `article`.`id`')->innerJoin('category', '`article_category`.`category_id` = `category`.`id`')->where(['category_id'=> $id])->all();
       return ArrayHelper::map($query, 'id','title');
    }
}
