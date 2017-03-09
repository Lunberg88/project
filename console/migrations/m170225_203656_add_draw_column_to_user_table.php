<?php

use yii\db\Migration;

/**
 * Handles adding draw to table `user`.
 */
class m170225_203656_add_draw_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'draw', $this->integer(5)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'draw');
    }
}
