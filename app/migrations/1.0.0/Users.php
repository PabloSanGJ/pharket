<?php

use Phalcon\Db\Column as Column;
use Phalcon\Db\Index as Index;
use Phalcon\Mvc\Model\Migration;

class UsersMigration_100 extends Migration
{
    public function up()
    {
        $this->morphTable(
            'users',
            [
                'columns' => [
                    new Column(
                        'id',
                        [
                            'type'          => Column::TYPE_INTEGER,
                            'size'          => 10,
                            'unsigned'      => true,
                            'notNull'       => true,
                            'first'         => true,
                        ]
                    ),
                    new Column(
                        'name',
                        [
                            'type'    => Column::TYPE_VARCHAR,
                            'size'    => 20,
                            'notNull' => true,
                            'after'   => 'id',
                        ]
                    ),
                    new Column(
                        'class',
                        [
                            'type'    => Column::TYPE_VARCHAR,
                            'size'    => 20,
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
        
        self::$_connection->execute('INSERT INTO `users`(`id`, `name`, `class`) VALUES (1, "Mr. Red", "btn-danger")');
        self::$_connection->execute('INSERT INTO `users`(`id`, `name`, `class`) VALUES (2, "Mrs. Yellow", "btn-warning")');
        self::$_connection->execute('INSERT INTO `users`(`id`, `name`, `class`) VALUES (3, "Mrs. Green", "btn-success")');
        self::$_connection->execute('INSERT INTO `users`(`id`, `name`, `class`) VALUES (4, "Mr. Blue", "btn-info")');
    }
}