<?php

use yii\db\Migration;

/**
 * Handles the creation of table `battles`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m170408_110257_create_battles_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('battles', [
            'id' => $this->primaryKey(),
            'logs' => $this->text(),
            'bid' => $this->integer(10)->notNull(),
            'creator_id' => $this->integer(10)->notNull(),
            'date' => $this->dateTime(),
            'status' => $this->integer(1)->notNull(),
        ]);

        // creates index for column `creator_id`
        $this->createIndex(
            'idx-battles-creator_id',
            'battles',
            'creator_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-battles-creator_id',
            'battles',
            'creator_id',
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
            'fk-battles-creator_id',
            'battles'
        );

        // drops index for column `creator_id`
        $this->dropIndex(
            'idx-battles-creator_id',
            'battles'
        );

        $this->dropTable('battles');
    }
}
