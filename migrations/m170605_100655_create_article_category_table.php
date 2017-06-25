<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m170605_100655_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'article_id'=>$this->integer(),
            'category_id'=>$this->integer()
        ]);
        // creates index for column `user_id`
        $this->createIndex(
            'category_article_article_id',
            'article_category',
            'article_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'category_article_article_id',
            'article_category',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );
        // creates index for column `user_id`
        $this->createIndex(
            'idx_category_id',
            'article_category',
            'category_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-category_id',
            'article_category',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
