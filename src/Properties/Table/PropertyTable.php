<?php

namespace App\Properties\Table;

use App\Framework\Database\Table;
use App\Properties\Entity\Property;
use Pagerfanta\Pagerfanta;
use App\Framework\Database\PaginatedQuery;

class PropertyTable extends Table
{

    protected $entity = Property::class;

    protected $table = 'properties';

    protected function paginationQuery(): string
    {
        return parent::paginationQuery() . " ORDER BY created_at DESC";
    }

}
