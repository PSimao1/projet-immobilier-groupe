<?php

namespace App\Properties\Table;

use App\Properties\Entity\Post;
use Pagerfanta\Pagerfanta;
use App\Framework\Database\PaginatedQuery;

class PropertyTable
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
     * @param int $perPage
     * @return Pagerfanta
     */
    public function findPaginated(int $perPage, int $currentPage): Pagerfanta
    {
        $query= new PaginatedQuery(
            $this->pdo,
            'SELECT * FROM properties',
            'SELECT COUNT(id) FROM properties',
            Post::class
        );
        return (new Pagerfanta($query))
            ->setMaxPerPage($perPage)
            ->setCurrentPage($currentPage);
    }

    /**
     * Récupère un article à partir de son ID
     * @param int $id
     * @return Post
     */
    public function find(string $slug): Post
    {
        $query = $this->pdo
            ->prepare('SELECT * FROM properties WHERE slug = ?');
        $query->execute([$slug]);
        $query->setFetchMode(\PDO::FETCH_CLASS, Post::class);
        return $query->fetch();
    }
}
