<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $date
 * @property string $image
 * @property integer $viewed
 * @property integer $user_id
 * @property integer $status
 * @property integer $category_id
 *
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    const CATEGORY_POLITICS = "2";
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title',  'content'], 'string'],
            [['date'], 'date','format'=>'php:Y-m-d'],
            [['date'], 'default','value'=>date('Y-m-d')],
            [['title'], 'string', 'max'=>255]
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
            'content' => 'Content',
            'date' => 'Date',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'user_id' => 'User ID',
            'status' => 'Status',
        ];
    }

    public function saveImage($filename) {

        $this->image = $filename;

        return $this->save(false);
    }

    public function getImage() {
        return ($this->image) ? '/uploads/' . $this->image : '/no-images.png';
    }

    public function deleteImage() {

        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }

    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('article_category', ['article_id' => 'id']);
    }

    public function getSelectedCategories() {
        $selectedIds = $this->getCategories()->select('id')->asArray()->all();
        return  ArrayHelper::getColumn($selectedIds, 'id');
    }

    public function getSelectedCategoriesForCurrentArticles() {
        $selectedCategories = $this->getCategories()->all();
        return  $selectedCategories;
    }

    public function saveCategories($categories) {
        if (is_array($categories)) {
            $this->clearCurrentCategories();
            foreach ($categories as $category_id) {
                $category = Category::findOne($category_id);
//                if ($tag != null) {
                $this->link('categories', $category);
//                    return true;
//                }
            }
        }
    }

    public function clearCurrentCategories() {

        ArticleCategory::deleteAll(['article_id'=>$this->id]);
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable('article_tag', ['article_id' => 'id']);
    }

    public function getSelectedTags() {
        $selectedIds = $this->getTags()->select('id')->asArray()->all();
        return  ArrayHelper::getColumn($selectedIds, 'id');
    }

    public function getSelectedTagsForCurrentArticle() {
        $selectedTags = $this->getTags()->all();
        return  $selectedTags;
    }

    public function saveTags($tags) {
        if (is_array($tags)) {
            $this->clearCurrentTags();
            foreach ($tags as $tag_id) {
                $tag = Tag::findOne($tag_id);
//                if ($tag != null) {
                    $this->link('tags', $tag);
//                    return true;
//                }
            }
        }
    }

    public function clearCurrentTags() {

       ArticleTag::deleteAll(['article_id'=>$this->id]);
    }

    public function getDate() {
        return Yii::$app->formatter->asDate($this->date);
    }

    public static function getAll($pageSize = 5) {
        // build a DB query to get all articles
        $query = Article::find();

        // get the total number of articles (but do not fetch the article data yet)
        $count = $query->count();

        // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);

        // limit the query using the pagination and retrieve the articles
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['articles'] = $articles;
        $data['pagination'] = $pagination;

        return $data;
    }

    public static function getPopular() {

        $query = Article::find()
            ->select([
                '{{article}}.id',
                '{{article}}.title',
                'COUNT({{comment}}.id) AS commentCount'
            ])
            ->joinWith('comments') // обеспечить построение промежуточной таблицы
                ->where(['{{comment}}.status' => 1, '{{comment}}.date' => date('Y-m-d') ])
            ->groupBy('{{article}}.id') // сгруппировать результаты, чтобы заставить агрегацию работать
            ->orderBy('commentCount desc')
            ->limit(3)
            ->all();

        return $query;
    }

    public static function getRecent() {
        return Article::find()->orderBy('date desc')->limit(4)->all();
    }

    public function getComments() {
        return $this->hasMany(Comment::className(), ['article_id'=>'id']);
    }

    public function getArticleComments() {
        return $this->getComments()->where(['status' => 1])->orderBy('plus desc')->all();
    }

    public function saveArticle() {
        $this->user_id = Yii::$app->user->id;
        return $this->save();
    }

    public function getAuthor() {
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }

    public function viewedCounter() {
        $this->viewed += 1;
        return $this->save(false);
    }

    public function currentView() {

    }
}
