<?php

$db_url = env("DATABASE_URL", null);

$testing_config = [
    'driver'   => 'sqlite',
    'database' => ':memory:',
    'prefix'   => '',
];

if($db_url !== null) {
    $db_url = parse_url($db_url);
    $db_connection = $db_url['scheme'];
    $db_host = $db_url["host"];
    $db_username = $db_url["user"];
    $db_password = $db_url["pass"];
    $db_name = substr($db_url["path"], 1);
    
    $config = [
        'fetch'       => PDO::FETCH_CLASS,
        'default'     => env('DB_CONNECTION', $db_connection),
        'connections' =>
            [
                'postgres' =>
                    [
                        'driver'   => 'pgsql',
                        'host'     => env('DB_HOST', $db_host),
                        'database' => env('DB_DATABASE', $db_name),
                        'username' => env('DB_USERNAME', $db_username),
                        'password' => env('DB_PASSWORD', $db_password),
                        'charset'  => 'utf8',
                        'prefix'   => '',
                        'schema'   => 'public',
                    ],
            ],
        'migrations'  => 'migrations',
    ];
}

$redis_url = env("REDIS_URL", null);
if($redis_url !== null) {
    $redis_url = parse_url($redis_url);
    $redis_host = $redis_url["host"];
    $redis_port = $redis_url["port"];
    $redis_password = $redis_url["pass"] ?? null;
    
    $config['redis'] =
        [
            'cluster' => false,
            'default' =>
                [
                    'host'     => env('REDIS_HOST', $redis_host),
                    'password' => env('REDIS_PASSWORD', $redis_password),
                    'port'     => env('REDIS_PORT', $redis_port),
                    'database' => 0,
                ],
        ];
}

$config['connections']['sqlite_testing'] = $testing_config;

return $config;
