<?php

namespace healthfirst\hfdashboard\migrations;

use Craft;
use craft\db\Migration;

/**
 * m230123_144200_access_monitor migration.
 */
class m230123_144200_access_monitor extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        if (!$this->db->tableExists('{{%access_monitor}}')) {
            $this->createTable(
                '{{%access_monitor}}',
                [
                    'id' => $this->primaryKey(),

                    'ip' => $this->string(40),
                    'language' => $this->string(12),
                    'site' => $this->string(90),
                    'url' => $this->string(90),
                    
                    'formInfo' => $this->json(),

                    'dateCreated' => $this->dateTime(),
                    'dateUpdated' => $this->dateTime(),
                    'dateDeleted' => $this->dateTime()->null(),
                    'uid' => $this->uid()
                ]
            );

            $this->createIndex(
                null,
                '{{%access_monitor}}',
                'id',
                false
            );

            $this->insert('{{%access_monitor}}', [
                'id' => 3250
            ]);

            $this->delete('{{%access_monitor}}', [
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
        $this->dropTableIfExists('{{%access_monitor}}');
        
        return true;
    }
}
