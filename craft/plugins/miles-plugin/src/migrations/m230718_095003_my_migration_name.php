<?php

namespace miles\craftmilesplugin\migrations;

use Craft;
use craft\db\Migration;

/**
 * m230718_095003_my_migration_name migration.
 */
class m230718_095003_my_migration_name extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        $this->addColumn("users","guid","string(36)");
        return true;

    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        //$this->dropColumn("users","guid");
        return true;
    }
}
