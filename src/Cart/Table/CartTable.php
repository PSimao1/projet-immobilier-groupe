<?php

namespace App\Cart\Table;

class CartTable
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Pagine les article
     *
     * @return \stdClass[]
     */
    public function findAll(): array
    {
        return $this->pdo
            ->query('SELECT * FROM cart ORDER BY created_at DESC LIMIT 10')
            ->fetchAll();
    }

    /**
     * Récupère un article à partir de son ID
     * @param int $id
     * @return \stdClass
     */
    public function find(int $id): \stdClass
    {
        $query = $this->pdo
            ->prepare('SELECT * FROM cart WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch();
    }
}