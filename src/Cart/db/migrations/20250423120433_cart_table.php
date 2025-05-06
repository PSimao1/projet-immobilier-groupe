<?php

use Phinx\Migration\AbstractMigration;

final class CartTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('cart')
        ->addColumn('created_at', 'datetime', ['null' => false])
        ->addColumn('updated_at', 'datetime', ['null' => false])
        ->addColumn('total_price', 'decimal', [
            'precision' => 5, 'scale' => 2,
            'null' => false
            ])
        ->addColumn('payment_method', 'string', ['null' => false])
        ->addColumn('unique_payment_id', 'integer', ['null' => false])
        ->addColumn('user_id', 'integer')
        ->addColumn('property_id', 'integer')
        ->addForeignKey('user_id', 'users', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION'
        ])
        ->addForeignKey('property_id', 'properties', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION'
        ])
        ->create();
    }
}