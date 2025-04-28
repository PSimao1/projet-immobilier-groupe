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
            ->addColumn('position', 'integer', ['null' => false])
            ->addColumn('property_id', 'integer')
            ->addForeignKey('property_id', 'properties', 'id', [
                'delete' => 'CASCADE', 
                'update' => 'NO_ACTION'
                ])
            ->create();
    }
}
