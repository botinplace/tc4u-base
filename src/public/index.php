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
date_default_timezone_set('Europe/Moscow');

// Определение констант
define('_SKEY', 1);
ignore_user_abort(true);
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . '' . DIRECTORY_SEPARATOR);
define('TEMPLATES', APP . 'Templates' . DIRECTORY_SEPARATOR);
define('SITE', ROOT . 'public' . DIRECTORY_SEPARATOR);
define('PROJECT_PREFIX', '');
define('BASE_URL', '');

// Подключение автозагрузчика Composer
require_once __DIR__ . '/../../vendor/autoload.php';

// Инициализация приложения
use Core\Application;
use Core\ErrorLogger;

$logger = new ErrorLogger(APP.'Logs/log', 1000);
$app = new Application();
$app->run();