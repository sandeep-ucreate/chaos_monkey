<?php


$config = [];

$db_url = env("DATABASE_URL", null);

if($db_url !== null && !empty(trim($db_url))) {
   $db_url = parse_url($db_url);
   $db_connection = $db_url['scheme'] == 'postgres' ? 'pgsql' : $db_url['scheme'];
   $db_host = $db_url["host"];
   $db_port = $db_url["port"];
   $db_username = $db_url["user"];
   $db_password = $db_url["pass"];
   $db_name = substr($db_url["path"], 1);

   $config = [
       'default'     => env('DB_CONNECTION', $db_connection),
       'connections' => [
           $db_connection => [
               'driver'      => $db_connection,
               'host'        => env('DB_HOST', $db_host),
               'port'        => env('DB_PORT', $db_port),
               'database'    => env('DB_DATABASE', $db_name),
               'username'    => env('DB_USERNAME', $db_username),
               'password'    => env('DB_PASSWORD', $db_password),
               'prefix'      => '',
               'unix_socket' => env('DB_SOCKET', ''),
               'charset'     => $db_connection == 'mysql' ? 'utf8mb4' : 'utf8',
               'collation'   => 'utf8mb4_unicode_ci',
               'strict'      => true,
               'engine'      => null,
               'schema'      => 'public',
               'sslmode'     => 'prefer',
           ],
       ],
       'migrations'  => 'migrations',
   ];
}

$redis_url = env("REDIS_URL", null);

if($redis_url !== null && !empty(trim($redis_url))) {
   $redis_url = parse_url($redis_url);
   $redis_host = $redis_url["host"];
   $redis_port = $redis_url["port"];
   $redis_password = $redis_url["pass"];

   $config['redis'] =
       [
           'client'  => 'predis',
           'default' => [
               'host'     => env('REDIS_HOST', $redis_host),
               'password' => env('REDIS_PASSWORD', $redis_password),
               'port'     => env('REDIS_PORT', $redis_port),
               'database' => env('REDIS_DB', 0),
           ],

           'cache' => [
               'host'     => env('REDIS_HOST', $redis_host),
               'password' => env('REDIS_PASSWORD', $redis_password),
               'port'     => env('REDIS_PORT', $redis_port),
               'database' => env('REDIS_DB', 0),
           ],
       ];
}

return $config;