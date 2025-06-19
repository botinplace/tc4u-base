<?php
require __DIR__ . '/../../vendor/autoload.php';

use Core\Config\LoadEnv;
use Core\Config\Config;
use Core\MigrationManager;

// Определение констант
define('_SKEY', 1);
ignore_user_abort(true);
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . '' . DIRECTORY_SEPARATOR);
define('TEMPLATES', APP . 'Templates' . DIRECTORY_SEPARATOR);
define('SITE', ROOT . 'public' . DIRECTORY_SEPARATOR);

define('ROOT_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR);
//define('APP_DIR', ROOT_DIR . '/app'. DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR);
define('PUBLIC_DIR', __DIR__);
define('CONFIG_DIR', APP_DIR . '/Config'. DIRECTORY_SEPARATOR);
define('PROJECT_PREFIX', '');
define('BASE_URL', '');

if (!function_exists('env')) {
    function env(string $key, $default = null) {
        return $_ENV[$key] ?? $default;
    }
}

if (!function_exists('storage_path')) {
    function storage_path(string $path = ''): string
    {
		return __DIR__ . '/../' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}


// Загрузка переменных окружения
Core\Config\LoadEnv::load('../.env');
Config::load();

try {
    // Указываем абсолютный путь к папке с миграциями
    $migrationsPath = __DIR__ . '/../migrations';
    
    // Можно указать имя подключения (по умолчанию 'default')
    $manager = new MigrationManager($migrationsPath, 'pgsql');
    $manager->run();
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}
