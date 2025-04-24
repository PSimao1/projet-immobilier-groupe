<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CategorieTable extends AbstractMigration
{
    
    public function change(): void
    {
        $this->table('categories', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'integer', ['identity' => true])
            ->addColumn('name', 'string', ['null' => false])
            ->addColumn('slug', 'string', ['null' => false])
            ->addColumn('picture', 'string', ['null' => false])
            ->addColumn('created_at', 'datetime', ['null' => false])
            ->addColumn('updated_at', 'datetime', ['null' => false])
            ->addColumn('user_id', 'integer')
            ->addColumn('is_online', 'boolean', ['null' => false])
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->create();
    }
}