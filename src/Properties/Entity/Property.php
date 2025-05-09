<?php

namespace App\Properties\Entity;

class Property
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
     * price
     *
     * @var mixed
     */
    public $price;    
    /**
     * area
     *
     * @var mixed
     */
    public $area;    
    /**
     * rooms
     *
     * @var mixed
     */
    public $rooms;    
    /**
     * carrez
     *
     * @var mixed
     */
    public $carrez;    
    /**
     * prefix_area
     *
     * @var mixed
     */
    public $prefix_area;    
    /**
     * land_area
     *
     * @var mixed
     */
    public $land_area;    
    /**
     * bedrooms
     *
     * @var mixed
     */
    public $bedrooms;    
    /**
     * bathrooms
     *
     * @var mixed
     */
    public $bathrooms;    
    /**
     * garages
     *
     * @var mixed
     */
    public $garages;    
    /**
     * construction_year
     *
     * @var mixed
     */
    public $construction_year;    
    /**
     * ac
     *
     * @var mixed
     */
    public $ac;    
    /**
     * swimming_pool
     *
     * @var mixed
     */
    public $swimming_pool;    
    /**
     * lawn
     *
     * @var mixed
     */
    public $lawn;    
    /**
     * barbecue
     *
     * @var mixed
     */
    public $barbecue;    
    /**
     * microwave
     *
     * @var mixed
     */
    public $microwave;    
    /**
     * television
     *
     * @var mixed
     */
    public $television;    
    /**
     * dryer
     *
     * @var mixed
     */
    public $dryer;    
    /**
     * outdoor_shower
     *
     * @var mixed
     */
    public $outdoor_shower;    
    /**
     * washer
     *
     * @var mixed
     */
    public $washer;    
    /**
     * gym
     *
     * @var mixed
     */
    public $gym;    
    /**
     * fridge
     *
     * @var mixed
     */
    public $fridge;    
    /**
     * wifi
     *
     * @var mixed
     */
    public $wifi;    
    /**
     * laundry
     *
     * @var mixed
     */
    public $laundry;    
    /**
     * sauna
     *
     * @var mixed
     */
    public $sauna;    
    /**
     * windows_curtains
     *
     * @var mixed
     */
    public $windows_curtains;    
    /**
     * adress
     *
     * @var mixed
     */
    public $adress;    
    /**
     * zip_code
     *
     * @var mixed
     */
    public $zip_code;    
    /**
     * city
     *
     * @var mixed
     */
    public $city;    
    /**
     * country
     *
     * @var mixed
     */
    public $country;    
    /**
     * longitude
     *
     * @var mixed
     */
    public $longitude;    
    /**
     * latitude
     *
     * @var mixed
     */
    public $latitude;    
    /**
     * category_id
     *
     * @var mixed
     */
    public $category_id;
        
    /**
     * category_name
     *
     * @var mixed
     */
    public $category_name;
    
    /**
     * user_id
     *
     * @var mixed
     */
    public $user_id;

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