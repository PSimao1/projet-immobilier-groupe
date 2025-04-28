<?php

namespace App\Blog\Entity;

class Post 
{        
    /**
     * id
     *
     * @var mixed
     */
    public $id;
    /**
     * slug
     *
     * @var mixed
     */
    public $slug;    
    /**
     * created_at
     *
     * @var mixed
     */
    public $created_at;    
    /**
     * updated_at
     *
     * @var mixed
     */
    public $updated_at;    
    /**
     * title
     *
     * @var mixed
     */
    public $title;    
    /**
     * description
     *
     * @var mixed
     */
    public $description;    
    /**
     * role
     *
     * @var mixed
     */
    public $role;    
    /**
     * picture
     *
     * @var mixed
     */
    public $picture;    
    /**
     * user_id
     *
     * @var mixed
     */
    public $user_id;

    public function __construct()
    {
        if($this->created_at) {
            $this->created_at = new \DateTime($this->created_at);
        }
        
        if($this->updated_at) {
            $this->updated_at = new \DateTime($this->updated_at);
        }
    }
}