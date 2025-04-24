<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ContactTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('contact')
        ->addColumn('last_name', 'string', ['null' => false])
        ->addColumn('first_name', 'string', ['null' => false])
        ->addColumn('phone_number', 'string', ['null' => false])
        ->addColumn('email', 'string', ['null' => false])
        ->addColumn('created_at', 'datetime', ['null' => false])
        ->addColumn('updated_at', 'datetime', ['null' => false])
        ->create();
    }
}