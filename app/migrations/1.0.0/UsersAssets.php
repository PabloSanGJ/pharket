<?php

use Phalcon\Db\Column as Column;
use Phalcon\Db\Index as Index;
use Phalcon\Db\Reference as Reference;
use Phalcon\Mvc\Model\Migration;

class UsersAssetsMigration_100 extends Migration
{
    public function up()
    {
        $this->morphTable(
            'users_assets',
            [
                'columns' => [
                    new Column(
                        'user_id',
                        [
                            'type'          => Column::TYPE_INTEGER,
                            'size'          => 10,
                            'unsigned'      => true,
                            'notNull'       => true,
                            'first'         => true,
                        ]
                    ),
                    new Column(
                        'asset_id',
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
                ],
                'indexes' => [
                    new Index(
                        'PRIMARY',
                        [
                            'user_id', 'asset_id'
                        ]
                    ),
                ],
                'references' => [
                    new Reference(
                        'users_assets_fk_users',
                        [
                            'referencedTable'   => 'users',
                            'columns'           => ['user_id'],
                            'referencedColumns' => ['id'],
                        ]
                    ),
                    new Reference(
                        'users_assets_fk_assets',
                        [
                            'referencedTable'   => 'assets',
                            'columns'           => ['asset_id'],
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
        
        self::$_connection->execute('INSERT INTO `users_assets`(`user_id`, `asset_id`, `quantity`) VALUES (1, 1, 10000)');
        self::$_connection->execute('INSERT INTO `users_assets`(`user_id`, `asset_id`, `quantity`) VALUES (2, 1, 10000)');
        self::$_connection->execute('INSERT INTO `users_assets`(`user_id`, `asset_id`, `quantity`) VALUES (3, 1, 10000)');
        self::$_connection->execute('INSERT INTO `users_assets`(`user_id`, `asset_id`, `quantity`) VALUES (4, 1, 10000)');
    }
}