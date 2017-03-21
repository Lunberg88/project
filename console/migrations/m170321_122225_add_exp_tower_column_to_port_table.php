<?php

use yii\db\Migration;

/**
 * Handles adding exp_tower to table `port`.
 */
class m170321_122225_add_exp_tower_column_to_port_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('port', 'exp_tower', $this->integer(1)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('port', 'exp_tower');
    }
}
