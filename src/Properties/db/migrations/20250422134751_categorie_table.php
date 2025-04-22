<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CategorieTable extends AbstractMigration
{
    
    public function change(): void
    {
        $this->table('categories', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'integer', ['identity' => true])
            //A finir
            ->create();
    }
}
