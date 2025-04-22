<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ImageTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $this->table('images')
            ->addColumn('create_at', 'datetime', ['null' => false])
            ->addColumn('update_at', 'datetime', ['null' => false])
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
