<?php

namespace healthfirst\hfdashboard\migrations;

use Craft;
use craft\db\Migration;

/**
 * m230123_144200_monitor_acess migration.
 */
class m230123_144200_monitor_acess extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        if (!$this->db->tableExists('{{%monitor_acess}}')) {
            $this->createTable(
                '{{%monitor_acess}}',
                [
                    'id' => $this->primaryKey(),

                    'ip' => $this->string(25),
                    'page' => $this->string(200),
                    'formInfo' => $this->json(),
                    'dateCreated' => $this->dateTime(),
                    'dateUpdated' => $this->dateTime(),
                    'dateDeleted' => $this->dateTime()->null(),
                    'uid' => $this->uid()
                ]
            );

            $this->createIndex(
                null,
                '{{%monitor_acess}}',
                'id',
                false
            );

            $this->insert('{{%monitor_acess}}', [
                'id' => 3250
            ]);

            $this->delete('{{%monitor_acess}}', [
                'id' => 3250
            ]);

            Craft::$app->db->schema->refresh();
        }

        return true;
    
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        echo "m230123_144200_monitor_acess cannot be reverted.\n";
        return false;
    }
}
