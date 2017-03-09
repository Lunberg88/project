<?php

use yii\db\Migration;

/**
 * Handles the creation of table `char`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m170217_104846_create_char_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('char', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(10)->notNull(),
            'level' => $this->integer(5)->notNull(),
            'strength' => $this->integer(5)->notNull(),
            'dexterity' => $this->integer(5)->notNull(),
            'stamina' => $this->integer(5)->notNull(),
            'hit_min' => $this->integer(5)->notNull(),
            'hit_max' => $this->integer(5)->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-char-user_id',
            'char',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-char-user_id',
            'char',
            'user_id',
            'user',
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
            'fk-char-user_id',
            'char'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-char-user_id',
            'char'
        );

        $this->dropTable('char');
    }
}
