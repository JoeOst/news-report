<?php

use yii\db\Migration;

/**
 * Handles dropping category_id from table `article`.
 */
class m170605_101225_drop_category_id_column_from_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('article', 'category_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('article', 'category_id', $this->integer());
    }
}
