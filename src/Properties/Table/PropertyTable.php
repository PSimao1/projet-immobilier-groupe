<?php

namespace App\Properties\Table;

use App\Framework\Database\Table;
use App\Properties\Entity\Property;
class PropertyTable extends Table
{

    protected $entity = Property::class;

    protected $table = 'properties';

    protected function paginationQuery(): string
    {
        return "SELECT properties.id, properties.title, categories_admin.name category_name
        FROM {$this->table}
        LEFT JOIN categories_admin ON properties.category_id = categories_admin.id
        ORDER BY properties.created_at DESC";
    }

}
