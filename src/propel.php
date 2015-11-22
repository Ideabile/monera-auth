<?php
$db_host = isset( $_ENV["DB_HOST"] )      ? $_ENV["DB_HOST"] : 'db';
$db_port = isset( $_ENV["DB_PORT"] )      ? $_ENV["DB_PORT"] : 5432;
$db_name = isset( $_ENV["DB_NAME"] )      ? $_ENV["DB_NAME"] : 'auth';
$db_user = isset( $_ENV["DB_USER"] )      ? $_ENV["DB_USER"] : 'auth';
$db_pass = isset( $_ENV["DB_PASSWORD"] )  ? $_ENV["DB_PASSWORD"] : 'auth';
return [
    'propel' => [
        'database' => [
            'connections' => [
                'auth' => [
                    'adapter'    => 'pgsql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'pgsql:host='.$db_host.';port='.$db_port.';dbname='.$db_name,
                    'user'       => $db_user,
                    'password'   => $db_pass,
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
