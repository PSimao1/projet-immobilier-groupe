<?php

namespace App\Blog\Table;

use App\Framework\Database\PaginatedQuery;
use Pagerfanta\Pagerfanta;

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
     * @param int $perPage
     * @return Pagerfanta
     */
    public function findPaginated(int $perPage, int $currentPage): Pagerfanta
    {
        $query= new PaginatedQuery(
            $this->pdo,
            'SELECT * FROM blog',
            'SELECT COUNT(id) FROM blog'
        );
        return (new Pagerfanta($query))
            ->setMaxPerPage($perPage)
            ->setCurrentPage($currentPage);
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
