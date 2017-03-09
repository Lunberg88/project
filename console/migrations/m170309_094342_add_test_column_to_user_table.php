<?php

use yii\db\Migration;

/**
 * Handles adding test to table `user`.
 */
class m170309_094342_add_test_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'test', $this->integer(5)->null());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'test');
    }
}
