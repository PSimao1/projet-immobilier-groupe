<?php

namespace App\Framework\Database;

use Pagerfanta\Adapter\AdapterInterface;


class PaginatedQuery implements AdapterInterface
{    
    private \PDO $pdo;
    private string $query;
    private string $countQuery;


    /**
     * @var string|null
     */
    private ?string $entity;
       
    /**
     * PaginatedQuery constructeur
     *
     * @param \PDO $pdo
     * @param string $query : requête qui récupère les resultats
     * @param string $countQuery : reqête qui compte le nombre de résultat total 
     * @param string|null $entity
     */
    public function __construct(\PDO $pdo, string $query, string $countQuery, ?string $entity)
    {
        $this->pdo = $pdo;
        $this->query = $query;
        $this->countQuery = $countQuery;
        $this->entity = $entity;
    }
    
    /**
     * getNbResults 
     *
     * @return int Le nombre de résultat
     */
    public function getNbResults(): int
    {
        return $this->pdo->query($this->countQuery)->fetchColumn();
    }
    
    /**
     * getSlice
     *
     * @param int $offset
     * @param int $length
     * @return Array
     */
    public function getSlice($offset, $length): array
    {
        $statement= $this->pdo->prepare($this->query . ' LIMIT :offset, :length');
        $statement->bindParam('offset', $offset, \PDO::PARAM_INT);
        $statement->bindParam('length', $length, \PDO::PARAM_INT);
        if($this->entity)
        {
            $statement->setFetchMode(\PDO::FETCH_CLASS, $this->entity);
        }
        $statement->execute();
        return $statement->fetchAll();
    }
}