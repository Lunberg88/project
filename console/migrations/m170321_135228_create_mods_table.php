<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mods`.
 * Has foreign keys to the tables:
 *
 * - `ship`
 */
class m170321_135228_create_mods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('mods', [
            'id' => $this->primaryKey(),
            'ship_id' => $this->integer(5)->notNull(),
            'mod_gun' => $this->integer(1)->notNull(),
            'mod_tower' => $this->integer(1)->notNull(),
            'exp_gun' => $this->integer(5)->notNull(),
            'exp_tower' => $this->integer(5)->notNull(),
            'cost_gun' => $this->integer(5)->notNull(),
            'cost_tower' => $this->integer(5)->notNull(),
        ]);

        // creates index for column `ship_id`
        $this->createIndex(
            'idx-mods-ship_id',
            'mods',
            'ship_id'
        );

        // add foreign key for table `ship`
        $this->addForeignKey(
            'fk-mods-ship_id',
            'mods',
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
        // drops foreign key for table `ship`
        $this->dropForeignKey(
            'fk-mods-ship_id',
            'mods'
        );

        // drops index for column `ship_id`
        $this->dropIndex(
            'idx-mods-ship_id',
            'mods'
        );

        $this->dropTable('mods');
    }
}
