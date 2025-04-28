<?php

namespace App\Framework\Database;

use Pagerfanta\Adapter\AdapterInterface;


class PaginatedQuery implements AdapterInterface
{    
    private \PDO $pdo;
    private string $query;
    private string $countQuery;
       
    /**
     * PaginatedQuery constructeur
     *
     * @param \PDO $pdo
     * @param string $query : requête qui récupère les resultats
     * @param string $countQuery : reqête qui compte le nombre de résultat total 
     */
    public function __construct(\PDO $pdo, string $query, string $countQuery)
    {
        $this->pdo = $pdo;
        $this->query = $query;
        $this->countQuery = $countQuery;
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
    public function getSlice(int $offset, int $length) : array
    {
        $statement= $this->pdo->prepare($this->query . ' LIMIT :offset, :length');
        $statement->bindParam('offset', $offset, \PDO::PARAM_INT);
        $statement->bindParam('length', $length, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
}