<?php

namespace App\Blog\Table;

class BlogTable
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
    public function findPaginated(): array
    {
        return $this->pdo
            ->query('SELECT * FROM blog ORDER BY created_at DESC LIMIT 10')
            ->fetchAll();
    }

    /**
     * Récupère un article à partir de son ID
     * @param int $id
     * @return \stdClass
     */
    public function find(string $slug): \stdClass
    {
        $query = $this->pdo
            ->prepare('SELECT * FROM blog WHERE slug = ?');
        $query->execute([$slug]);
        return $query->fetch();
    }
}
