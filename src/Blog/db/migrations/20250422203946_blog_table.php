<?php

use Phinx\Migration\AbstractMigration;

final class BlogTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('blog')
        ->addColumn('created_at', 'datetime', ['null' => false])
        ->addColumn('updated_at', 'datetime', ['null' => false])
        ->addColumn('title', 'string', ['null' => false])
        ->addColumn('description', 'text', [
            'limit' => \Phinx\Db\Adapter\MysqlAdapter::TEXT_LONG,
            'null' => false
            ])
        ->addColumn('slug', 'text', ['null' => false])
        ->addColumn('username', 'text', ['null' => false])
        ->create();
    }
}
