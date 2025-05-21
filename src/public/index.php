<?php

declare(strict_types=1);

// Настройка отображения ошибок (включайте только в разработке)
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
 
// Установка заголовков для безопасности и поддержки контента
function setupHeaders(array $customHeaders = []): void {
    if (headers_sent()) {
        return; // Прерывание, если заголовки уже отправлены
    }
    
    header('Content-Type: text/html; charset=utf-8');
    
    if (function_exists('header_remove')) {
        header_remove('X-Powered-By');
    } else {
        @ini_set('expose_php', 'off');
    }

    header('X-XSS-Protection: 1; mode=block');
    header('Strict-Transport-Security: max-age=7776000; includeSubDomains; preload');
    header('X-Frame-Options: DENY');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('X-Content-Type-Options: nosniff');
    header('x-permitted-cross-domain-policies: none');
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');

    // Дополнительные пользовательские заголовки
    foreach ($customHeaders as $key => $value) {
        header("$key: $value");
    }
}

// Можно вызывать функцию без дополнительных заголовков
setupHeaders();

// Установка часового пояса
//date_default_timezone_set('Europe/Moscow');
date_default_timezone_set($_ENV['APP_TIMEZONE'] ?? 'Europe/Moscow');

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


// Подключение автозагрузчика Composer
require_once __DIR__ . '/../../vendor/autoload.php';

// Инициализация приложения
use Core\Application;
use Core\ErrorLogger;
use Core\Config\Config;
use Core\Config\LoadEnv;


if (!function_exists('env')) {
    function env(string $key, $default = null) {
        return $_ENV[$key] ?? $default;
    }
}

if (!function_exists('storage_path')) {
    function storage_path(string $path = ''): string
    {
        //return __DIR__ . '/../storage' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
		return __DIR__ . '/../' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

// Загрузка переменных окружения
Core\Config\LoadEnv::load('../.env');
Config::load();

$logger = new ErrorLogger(ROOT.'Logs/log', 1000);

// Глобальный обработчик исключений
set_exception_handler(function (\Throwable $e) use ($logger) {
    $logger->handleException($e);
    http_response_code(500);
    exit('Internal Server Error');
});

$app = new Application();

$app->run();
