<?php

use yii\db\Migration;

/**
 * Class m000000_000000_wildberries_settings
 */
class m000000_000000_wildberries_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%settings}}', [
            'key' => 'wb_api_key',
            'value' => '',
            'description' => 'Wildberries API Key',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%settings}}', ['key' => 'wb_api_key']);
    }
}
