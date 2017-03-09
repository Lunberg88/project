<?php

use yii\db\Migration;

/**
 * Handles adding lose to table `user`.
 */
class m170225_203634_add_lose_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'lose', $this->integer(5)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'lose');
    }
}
