<?php

use yii\db\Migration;

/**
 * Handles adding win to table `user`.
 */
class m170225_203605_add_win_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'win', $this->integer(5)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'win');
    }
}
