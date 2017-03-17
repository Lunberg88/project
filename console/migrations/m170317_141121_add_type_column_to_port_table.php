<?php

use yii\db\Migration;

/**
 * Handles adding type to table `port`.
 */
class m170317_141121_add_type_column_to_port_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('port', 'type', $this->integer(2)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('port', 'type');
    }
}
