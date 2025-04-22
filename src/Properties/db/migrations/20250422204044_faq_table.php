<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class FaqTable extends AbstractMigration
{

    public function change(): void
    {
        $this->table('faq')
        ->addColumn('created_at', 'datetime', ['null' => false])
        ->addColumn('updated_at', 'datetime', ['null' => false])
        ->addColumn('request', 'string', ['null' => false])
        ->addColumn('response', 'text', ['null' => false])
        ->create();

    }
}
