<?php

use yii\db\Migration;

/**
 * Handles dropping win from table `user`.
 */
class m170225_203359_drop_win_column_from_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('user', 'win');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('user', 'win', $this->integer(5));
    }
}
