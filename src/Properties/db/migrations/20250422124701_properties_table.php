<?php

use Phinx\Migration\AbstractMigration;

final class PropertiesTable extends AbstractMigration
{
    public function change(): void
    {
        if($this->hasTable('properties'))
        {
            $this->table('properties')->drop()->save();
        }
        
        $this->table('properties', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'integer', ['identity' => true])
            ->addColumn('slug', 'string', ['null' => false])
            ->addColumn('title', 'string', ['null' => false])
            ->addColumn('description', 'text', [
                'limit' => \Phinx\Db\Adapter\MysqlAdapter::TEXT_LONG,
                'null' => false
                ])
            ->addColumn('price', 'decimal', [
                'precision' => 11, 'scale' => 2,
                'null' => false
                ])
            ->addColumn('area', 'decimal', [
                'precision' => 7, 'scale' => 2,
                'null' => false
                ])
            ->addColumn('rooms', 'integer', ['null' => false])
            ->addColumn('carrez', 'decimal', [
                'precision' => 7, 'scale' => 2,
                'null' => false
                ])
            ->addColumn('prefix_area', 'string', ['null' => false])
            ->addColumn('land_area', 'decimal', [
                'precision' => 10, 'scale' => 2,
                'null' => false
                ])
            ->addColumn('bedrooms', 'integer', ['null' => false])
            ->addColumn('bathrooms', 'integer', ['null' => false])
            ->addColumn('garages', 'integer', ['null' => false])
            ->addColumn('construction_year', 'year', ['null' => false])
            ->addColumn('ac', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('swimming_pool', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('lawn', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('barbecue', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('microwave', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('television', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('dryer', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('outdoor_shower', 'boolean', ['null' => false, 'default' => false] )
            ->addColumn('washer', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('gym', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('fridge', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('wifi', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('laundry', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('sauna', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('windows_curtains', 'boolean', ['null' => false, 'default' => false])
            ->addColumn('adress', 'string', ['null' => false])
            ->addColumn('zip_code', 'string', ['null' => false])
            ->addColumn('city', 'string', ['null' => false])
            ->addColumn('country', 'string', ['null' => false])
            ->addColumn('longitude', 'string', ['null' => false])
            ->addColumn('latitude', 'string', ['null' => false])
            ->addColumn('created_at', 'datetime', ['null' => false])
            ->addColumn('updated_at', 'datetime', ['null' => false])
            ->addColumn('user_id', 'integer')
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->addColumn('category_id', 'integer')
            ->addForeignKey('category_id', 'categories', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->create();
    }
}