<?php

namespace App\Properties\Table;

use App\Framework\Database\Table;

class CategoryTable extends Table
{
    protected $table = 'categories_admin';

    protected function paginationQuery(): string
    {
        return parent::paginationQuery() . " ORDER BY created_at DESC";
    }
}
