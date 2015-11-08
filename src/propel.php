<?php
return [
    'propel' => [
        'database' => [
            'connections' => [
                'auth' => [
                    'adapter'    => 'pgsql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'pgsql:host=login_db_1;port=5432;dbname=auth;user=root;password=root',
                    'user'       => 'root',
                    'password'   => 'root',
                    'attributes' => [],
                    'settings'   => [
                        'charset'   => 'utf8',
                        'queries'   => [
                            'utf8'    =>  "SET NAMES 'UTF8'"
                          ]
                      ]
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'auth',
            'connections' => ['auth']
        ],
        'generator' => [
            'defaultConnection' => 'auth',
            'connections' => ['auth'],
            'platformClass' => 'Propel\Generator\Platform\PgsqlPlatform',
            'schema' => [
                'autoPackage' => true
            ]
        ]
    ]
];
