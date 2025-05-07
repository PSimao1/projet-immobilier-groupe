<?php

namespace App\Framework\Database;



use Pagerfanta\Pagerfanta;

class Table
{

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * Nom de la table en bdd
     * @var string
     */
    protected $table;

    /**
     * Entité a utiliser
     * @var string|null
     */
    protected $entity;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Pagine les éléments
     * @param int $perPage
     * @return Pagerfanta
     */
    public function findPaginated(int $perPage, int $currentPage): Pagerfanta
    {
        $query= new PaginatedQuery(
            $this->pdo,
            $this->paginationQuery(),
            'SELECT COUNT(id) FROM properties',
            $this->entity
        );
        return (new Pagerfanta($query))
            ->setMaxPerPage($perPage)
            ->setCurrentPage($currentPage);
    }

    protected function paginationQuery()
    {
        return "SELECT * FROM {$this->table}";

    }
    /**
     * Récupère un élément à partir de son ID
     * @param int $id
     * @return mixed
     */
    public function find(string $slug)
    {
        $query = $this->pdo
            ->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $query->execute([$slug]);

        if ($this->entity) {
            $query->setFetchMode(\PDO::FETCH_CLASS, $this->entity);
        }

        return $query->fetch() ?: null;
    }

    public function update(int $id, array $params): bool
    {
        $fieldQuery = $this->buildFieldQuery($params);
        $params['id']=$id;
        $stmt= $this->pdo->prepare("UPDATE {$this->table} SET $fieldQuery WHERE id = :id");
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
        $values = join(', ', array_map(function($fields) {
            return ':' . $fields;
        }, $fields));
        $fields = join(', ', $fields);
            $stmt = $this->pdo->prepare(
            "INSERT INTO {$this->table} ($fields) VALUES($values)"
        );
        return $stmt->execute($params);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * @return string
     */
    public function getEntity(): string
    {
        return $this->entity;
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }
}
