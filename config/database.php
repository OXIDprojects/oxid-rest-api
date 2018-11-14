<?php
// check if OXID shop available ...
if (file_exists(__DIR__ . '/../../config.inc.php')) {
    /**
     * Helper for loading and getting the config file contents
     */
    class RestConfigFileReader
    {
        /**
         * RestConfigFileReader constructor.
         */
        public function __construct()
        {
            include __DIR__ . '/../../config.inc.php';
        }
    }
    // yes, so load OXID config file
    $configFile = new \RestConfigFileReader();
    // and return specific config values
    return [
        'default' => env('DB_CONNECTION', 'mysql'),
        'connections' => [
            'mysql' => [
                'driver' => 'mysql',
                'host' => $configFile->dbHost,
                'port' => $configFile->dbPort,
                'database' => $configFile->dbName,
                'username' => $configFile->dbUser,
                'password' => $configFile->dbPwd,
                'unix_socket' => env('DB_SOCKET', ''),
                'charset' => env('DB_CHARSET', 'utf8mb4'),
                'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
                'prefix' => env('DB_PREFIX', ''),
                'strict' => env('DB_STRICT_MODE', true),
                'engine' => env('DB_ENGINE', null),
                'timezone' => env('DB_TIMEZONE', '+00:00'),
            ],
        ],
    ];
}
// no OXID, use default .env vars
return [
    'default' => env('DB_CONNECTION', 'mysql'),
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', 3306),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => env('DB_PREFIX', ''),
            'strict' => env('DB_STRICT_MODE', true),
            'engine' => env('DB_ENGINE', null),
            'timezone' => env('DB_TIMEZONE', '+00:00'),
        ],
    ],
];
