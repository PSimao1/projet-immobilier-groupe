<?php

use Phinx\Migration\AbstractMigration;

final class PropertiesTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('properties', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'integer', ['identity' => true])
            ->addColumn('title', 'string', ['null' => false])
            ->addColumn('description', 'text', [
                'limit' => \Phinx\Db\Adapter\MysqlAdapter::TEXT_LONG,
                'null' => false
                ])
            //->addColumn('sub_category', 'integer')
            ->addColumn('price', 'decimal', [
                'precision' => 11, 'scale' => 2,
                'null' => false
                ])
            ->addColumn('area', 'decimal', [
                'precision' => 4, 'scale' => 2,
                'null' => false
                ])
            ->addColumn('rooms', 'integer', ['null' => false])
            ->addColumn('carrez', 'decimal', [
                'precision' => 4, 'scale' => 2,
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
            ->addColumn('ac', 'boolean', ['null' => false])
            ->addColumn('swimming_pool', 'boolean', ['null' => false])
            ->addColumn('lawn', 'boolean', ['null' => false])
            ->addColumn('barbecue', 'boolean', ['null' => false])
            ->addColumn('microwave', 'boolean', ['null' => false])
            ->addColumn('television', 'boolean', ['null' => false])
            ->addColumn('dryer', 'boolean', ['null' => false])
            ->addColumn('outdoor_shower', 'boolean', ['null' => false])
            ->addColumn('washer', 'boolean', ['null' => false])
            ->addColumn('gym', 'boolean', ['null' => false])
            ->addColumn('fridge', 'boolean', ['null' => false])
            ->addColumn('wifi', 'boolean', ['null' => false])
            ->addColumn('laundry', 'boolean', ['null' => false])
            ->addColumn('sauna', 'boolean', ['null' => false])
            ->addColumn('windows_curtains', 'boolean', ['null' => false])
            ->addColumn('adress', 'string', ['null' => false])
            ->addColumn('zip_code', 'string', ['null' => false])  
            ->addColumn('city', 'string', ['null' => false])
            ->addColumn('country', 'string', ['null' => false])
            ->addColumn('longitude', 'string', ['null' => false])
            ->addColumn('latitude', 'string', ['null' => false])
            ->create();
    }
}
