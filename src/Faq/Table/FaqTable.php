<?php

namespace App\Faq\Table;

class FaqTable
{
    public function __construct(
        private \PDO $pdo
    ){}

    public function findAll(): array
    {
        return $this->pdo
            ->query('SELECT * FROM faq ORDER BY created_at DESC LIMIT 10')
            ->fetchAll()
        ;
    }

}
