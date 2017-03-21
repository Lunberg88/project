<?php

use yii\db\Migration;

/**
 * Handles adding exp_gun to table `port`.
 */
class m170321_122136_add_exp_gun_column_to_port_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('port', 'exp_gun', $this->integer(1)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('port', 'exp_gun');
    }
}
