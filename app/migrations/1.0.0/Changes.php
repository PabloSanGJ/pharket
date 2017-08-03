<?php

use Phalcon\Db\Column as Column;
use Phalcon\Db\Index as Index;
use Phalcon\Db\Reference as Reference;
use Phalcon\Mvc\Model\Migration;

class ChangesMigration_100 extends Migration
{
    public function up()
    {
        $this->morphTable(
            'changes',
            [
                'columns' => [
                    new Column(
                        'id',
                        [
                            'type'          => Column::TYPE_INTEGER,
                            'size'          => 10,
                            'unsigned'      => true,
                            'notNull'       => true,
                            'autoIncrement' => true,
                            'first'         => true,
                        ]
                    ),
                    new Column(
                        'user_id',
                        [
                            'type'          => Column::TYPE_INTEGER,
                            'size'          => 10,
                            'unsigned'      => true,
                            'notNull'       => true,
                        ]
                    ),
                    new Column(
                        'asset_from',
                        [
                            'type'          => Column::TYPE_INTEGER,
                            'size'          => 10,
                            'unsigned'      => true,
                            'notNull'       => true,
                        ]
                    ),
                    new Column(
                        'asset_to',
                        [
                            'type'          => Column::TYPE_INTEGER,
                            'size'          => 10,
                            'unsigned'      => true,
                            'notNull'       => true,
                        ]
                    ),
                    new Column(
                        'quantity',
                        [
                            'type'          => Column::TYPE_FLOAT,
                            'size'          => 10,
                            'unsigned'      => true,
                            'notNull'       => true,
                        ]
                    ),
                    new Column(
                        'country',
                        [
                            'type'          => Column::TYPE_CHAR,
                            'size'          => 2,
                            'notNull'       => false,
                        ]
                    ),
                    new Column(
                        'when',
                        [
                            'type'          => Column::TYPE_TIMESTAMP,
                            'notNull'       => true,
                        ]
                    ),
                ],
                'indexes' => [
                    new Index(
                        'PRIMARY',
                        [
                            'id'
                        ]
                    ),
                    new Index(
                        'asset_from',
                        [
                            'asset_from',
                        ]
                    ),
                    new Index(
                        'asset_to',
                        [
                            'asset_to',
                        ]
                    ),
                    new Index(
                        'country',
                        [
                            'country',
                        ]
                    ),
                ],
                'references' => [
                    new Reference(
                        'changes_fk_users',
                        [
                            'referencedTable'   => 'users',
                            'columns'           => ['user_id'],
                            'referencedColumns' => ['id'],
                        ]
                    ),
                ],
                'options' => [
                    'TABLE_TYPE'      => 'BASE TABLE',
                    'ENGINE'          => 'InnoDB',
                    'TABLE_COLLATION' => 'utf8_general_ci',
                ],
            ]
        );
    }
}