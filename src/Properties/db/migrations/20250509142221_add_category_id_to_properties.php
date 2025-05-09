<?php

use Phinx\Migration\AbstractMigration;

final class AddCategoryIdToProperties extends AbstractMigration
{
    public function change(): void
    {
        $this->table('properties')
            ->addColumn('category_id', 'integer', ['null' => true])
            ->addForeignKey('category_id', 'categories', 'id', [
                'delete' => 'SET NULL'
            ])
            ->update();
    }
}
