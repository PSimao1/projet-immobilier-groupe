<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ProjectTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('project')
        ->addColumn('created_at', 'datetime', ['null' => false])
        ->addColumn('updated_at', 'datetime', ['null' => false])
        ->addColumn('published_at', 'datetime', ['null' => false])
        ->addColumn('picture', 'string', ['null' => false])
        ->addColumn('title', 'string', ['null' => false])
        ->addColumn('description', 'text', [
            'limit' => \Phinx\Db\Adapter\MysqlAdapter::TEXT_LONG,
            'null' => false
            ])
        ->addColumn('slug', 'text', ['null' => false])
        ->addColumn('category_id', 'integer')
            ->addForeignKey('category_id', 'categories', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
        ->create();
    }
}
