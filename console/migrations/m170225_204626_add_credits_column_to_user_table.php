<?php

use yii\db\Migration;

/**
 * Handles adding credits to table `user`.
 */
class m170225_204626_add_credits_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'credits', $this->integer(5)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'credits');
    }
}
