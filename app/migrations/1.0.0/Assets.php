<?php

use Phalcon\Db\Column as Column;
use Phalcon\Db\Index as Index;
use Phalcon\Mvc\Model\Migration;

class AssetsMigration_100 extends Migration
{
    public function up()
    {
        $this->morphTable(
            'assets',
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
                        'name',
                        [
                            'type'    => Column::TYPE_VARCHAR,
                            'size'    => 255,
                            'notNull' => true,
                            'after'   => 'id',
                        ]
                    ),
                ],
                'indexes' => [
                    new Index(
                        'PRIMARY',
                        [
                            'id',
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
        
        self::$_connection->execute('INSERT INTO `assets`(`id`, `name`) VALUES (1, "USD")');
        self::$_connection->execute('INSERT INTO `assets`(`id`, `name`) VALUES (2, "EUR")');
        self::$_connection->execute('INSERT INTO `assets`(`id`, `name`) VALUES (3, "JPY")');
        self::$_connection->execute('INSERT INTO `assets`(`id`, `name`) VALUES (4, "GBP")');
        self::$_connection->execute('INSERT INTO `assets`(`id`, `name`) VALUES (5, "AUD")');
        self::$_connection->execute('INSERT INTO `assets`(`id`, `name`) VALUES (6, "CAD")');
        self::$_connection->execute('INSERT INTO `assets`(`id`, `name`) VALUES (7, "CHF")');
        self::$_connection->execute('INSERT INTO `assets`(`id`, `name`) VALUES (8, "CNY")');
        self::$_connection->execute('INSERT INTO `assets`(`id`, `name`) VALUES (9, "MXN")');
        self::$_connection->execute('INSERT INTO `assets`(`id`, `name`) VALUES (10, "SEK")');
    }
}