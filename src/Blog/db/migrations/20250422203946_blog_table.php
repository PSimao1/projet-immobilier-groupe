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
        ->addColumn('role', 'json', ['null' => false])
        ->addColumn('picture', 'string', ['null' => false])
        ->addColumn('user_id', 'integer')
        ->addForeignKey('user_id', 'users', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION'
        ])
        ->create();
    }
}