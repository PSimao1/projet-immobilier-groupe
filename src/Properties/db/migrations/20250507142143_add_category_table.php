<?php

use Phinx\Migration\AbstractMigration;

final class AddCategoryTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('categories_admin')
        ->addColumn('name', 'string', ['null' => false])
        ->addColumn('slug', 'string', ['null' => false])
        ->addColumn('created_at', 'datetime', ['null' => false])
         ->create();
    }
}
