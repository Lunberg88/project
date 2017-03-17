<?php

use yii\db\Migration;

/**
 * Handles the creation of table `port`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `ship`
 */
class m170317_132341_create_port_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('port', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(10)->notNull(),
            'ship_id' => $this->integer(5)->notNull(),
            'exp' => $this->integer(5)->notNull(),
            'stock_gun' => $this->integer(1)->notNull(),
            'stock_tower' => $this->integer(1)->notNull(),
            'mod_gun' => $this->integer(1)->notNull(),
            'mod_tower' => $this->integer(1)->notNull(),
            'strength' => $this->integer(10)->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-port-user_id',
            'port',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-port-user_id',
            'port',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `ship_id`
        $this->createIndex(
            'idx-port-ship_id',
            'port',
            'ship_id'
        );

        // add foreign key for table `ship`
        $this->addForeignKey(
            'fk-port-ship_id',
            'port',
            'ship_id',
            'ship',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-port-user_id',
            'port'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-port-user_id',
            'port'
        );

        // drops foreign key for table `ship`
        $this->dropForeignKey(
            'fk-port-ship_id',
            'port'
        );

        // drops index for column `ship_id`
        $this->dropIndex(
            'idx-port-ship_id',
            'port'
        );

        $this->dropTable('port');
    }
}
