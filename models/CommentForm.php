<?php
namespace app\models;

use yii\base\Model;
use yii\helpers\ArrayHelper;

class CommentForm extends Model {

    public $comment;

    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3, 250]]
        ];
    }

    public function saveComment($article_id) {
        $comment = new Comment();
        $p = Article::CATEGORY_POLITICS;

        $comment->text = $this->comment;
        $comment->user_id = \Yii::$app->user->id;
        $comment->article_id = $article_id;

        $categories = Article::findOne($article_id)->getSelectedCategories();


        if (in_array($p, $categories)) {
            $comment->status = 0;
        } else {
            $comment->status = 1;
        }
        $comment->date = date('Y-m-d');
        return $comment->save();
    }
}