<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ImageTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('images')
            ->addColumn('created_at', 'datetime', ['null' => false])
            ->addColumn('updated_at', 'datetime', ['null' => false])
            ->addColumn('name', 'string', ['null' => false])
            ->addColumn('postion', 'integer', ['null' => false])
            ->addColumn('properties_id', 'integer')
            ->addForeignKey('properties_id', 'properties', 'id', [
                'delete' => 'CASCADE', 
                'update' => 'NO_ACTION'
                ])
            ->create();
    }
}
