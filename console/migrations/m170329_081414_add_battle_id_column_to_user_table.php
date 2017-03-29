<?php

use yii\db\Migration;

/**
 * Handles adding battle_id to table `user`.
 */
class m170329_081414_add_battle_id_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'battle_id', $this->integer(10)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'battle_id');
    }
}
