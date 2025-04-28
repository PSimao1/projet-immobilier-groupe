<?php

namespace App\Home\Table;

class HomeTable
{
    public function __construct(private \PDO $pdo)
    {
        $this->pdo=$pdo;
    }
    
    public function showSixProperty()
    {
        return $this->pdo
            ->query('SELECT properties.*, images.*
                    FROM properties
                    LEFT JOIN images ON properties.id = images.property_id
                    ORDER BY properties.id DESC
                    LIMIT 6;')
            ->fetchAll();
    }
    
    /**
     * Récupère une propriété par son ID
     *
     * @param string $slug
     * @return stdClass
     */
    public function showDetailProperty(string $slug): \stdClass
    {
        $query = $this->pdo
        ->prepare('SELECT * FROM properties WHERE slug= ?');
    $query->execute([$slug]);
    return $query->fetch();
    }


    public function showThreeBlog()
    {
        return $this->pdo
        ->query('SELECT blog.*, users.first_name 
                FROM blog 
                LEFT JOIN users ON blog.user_id = users.id 
                ORDER BY blog.created_at DESC 
                LIMIT 3')
        ->fetchAll();
    }
    
    /**
     * Récupère un article du blog par son ID
     *
     * @param string $slug
     * @return stdClass
     */
    public function showDetailBlog(string $slug): \stdClass
    {
        $query = $this->pdo
        ->prepare('SELECT * FROM blog WHERE slug= ?');
    $query->execute([$slug]);
    return $query->fetch();
    }
}