<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ship`.
 */
class m170317_132201_create_ship_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('ship', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'lvl' => $this->integer(5)->notNull(),
            'stock_gun' => $this->integer(1)->notNull(),
            'stock_tower' => $this->integer(1)->notNull(),
            'mod_gun' => $this->integer(1)->notNull(),
            'mod_tower' => $this->integer(1)->notNull(),
            'strength' => $this->integer(10)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('ship');
    }
}
