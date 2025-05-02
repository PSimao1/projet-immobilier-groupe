<?php

namespace App\Properties\Table;

use App\Properties\Entity\Property;
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
            Property::class
        );
        return (new Pagerfanta($query))
            ->setMaxPerPage($perPage)
            ->setCurrentPage($currentPage);
    }

    /**
     * Récupère un article à partir de son ID
     * @param int $id
     * @return Property
     */
    public function find(string $slug): Property
    {
        $query = $this->pdo
            ->prepare('SELECT * FROM properties WHERE slug = ?');
        $query->execute([$slug]);
        $query->setFetchMode(\PDO::FETCH_CLASS, Property::class);
        return $query->fetch();
    }

    public function update(int $id, array $params): bool
    {
        $fieldQuery = $this->buildFieldQuery($params);
        $params['id']=$id;
        $stmt= $this->pdo->prepare("UPDATE properties SET $fieldQuery WHERE id = :id");
        return $stmt->execute($params);

    }

    public function buildFieldQuery(array $params)
    {
        return join(',', array_map(function($field){
            return "$field = :$field";
        }, array_keys($params)));
    }

    public function insert(array $params): bool
    {
        $fields = array_keys($params);
        $values = array_map(function($fields) {
            return ':' . $fields;
        }, $fields); 
        $stmt = $this->pdo->prepare(
            "INSERT INTO posts (" .
                join(',', $fields)
            . ") VALUES(" .
                join(',', $values)
            . ")"
        ); 
        return $stmt->execute($params);
    }

    public function delete(int $id): bool
    {
        $stmt=$this->pdo->prepare('DELETE FROM properties WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
