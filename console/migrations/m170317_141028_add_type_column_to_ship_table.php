<?php

use yii\db\Migration;

/**
 * Handles adding type to table `ship`.
 */
class m170317_141028_add_type_column_to_ship_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('ship', 'type', $this->integer(2)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('ship', 'type');
    }
}
