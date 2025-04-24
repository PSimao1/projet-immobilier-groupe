<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AboutTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('about'/*, ['id' => false, 'primary_key' => ['id']]*/)
        //->addColumn('id', 'integer', ['identity' => true])
        ->addColumn('title', 'string', ['null' => false])
        ->addColumn('description', 'text', [
            'limit' => \Phinx\Db\Adapter\MysqlAdapter::TEXT_LONG,
            'null' => false
            ])
        ->addColumn('slug', 'text', ['null' => false])
        ->addColumn('created_at', 'datetime', ['null' => false])
        ->addColumn('updated_at', 'datetime', ['null' => false])
        ->create();
    }
}
