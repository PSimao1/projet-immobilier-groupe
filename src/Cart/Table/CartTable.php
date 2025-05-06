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
    public function findAllWithProperties(): array
    {
        $stmt = $this->pdo->query(
        'SELECT cart.*, properties.title, properties.adress, properties.zip_code, properties.city, properties.price
        FROM cart
        JOIN properties ON cart.property_id = properties.id
        ORDER BY cart.created_at DESC
        LIMIT 10'
    );
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un article à partir de son ID
     * @param int $id
     * @return \stdClass
     */
    public function find(int $id): \stdClass
    {
        $query = $this->pdo->prepare(
            'SELECT
            cart.id,
            properties.title,
            properties.adress,
            properties.zip_code,
            properties.city,
            properties.price
            FROM
            cart
            WHERE
            id = ?
            JOIN
            properties ON cart.id = properties.id'
        );
        $query->execute([$id]);
        return $query->fetch();
    }  
}