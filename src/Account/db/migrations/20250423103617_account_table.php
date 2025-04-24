<?php


use Phinx\Migration\AbstractMigration;

final class AccountTable extends AbstractMigration
{

    public function change(): void
    {
        $this->table('users', [
                'id' => false, 
                'primary_key' => ['id']
            ]
        )
        ->addColumn('id', 'integer', [
            'identity' => true
        ])
        ->addColumn('last_name', 'string', ['null' => false])
        ->addColumn('first_name', 'string', ['null' => false])
        ->addColumn('phone_number', 'string', ['null' => false])
        ->addColumn('password', 'string', ['null' => false])
        ->addColumn('address', 'string', ['null' => false])
        ->addColumn('role', 'string', ['null' => false])
        ->addColumn('is_valid', 'boolean', ['null' => false])
        ->addColumn('last_login', 'datetime', ['null' => false])
        ->addColumn('picture', 'string', ['null' => false])
        ->addColumn('email', 'string', ['null' => false])
        ->addColumn('created_at', 'datetime', ['null' => false])
        ->addColumn('updated_at', 'datetime', ['null' => false])
        ->create();
    }
}
