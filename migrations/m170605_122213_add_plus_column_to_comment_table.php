<?php

use yii\db\Migration;

/**
 * Handles adding plus to table `comment`.
 */
class m170605_122213_add_plus_column_to_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('comment', 'plus', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('comment', 'plus');
    }
}
