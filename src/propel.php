<?php
return [
    'propel' => [
        'database' => [
            'connections' => [
                'auth' => [
                    'adapter'    => 'pgsql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'pgsql:host='.$_ENV["DB_HOST"].';port='.$_ENV["DB_PORT"].';dbname='.$_ENV["DB_NAME"],
                    'user'       => $_ENV["DB_USER"],
                    'password'   => $_ENV["DB_PASSWORD"],
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
