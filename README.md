# tc4u-base
Базовое приложение, используещее tc4u. Можно использовать как основу проекта.

Настройки, маршруты, контроллеры, шаблон, контент.

Представляю инструкцию по установке и настройке:

---

# Инструкция по установке TC4U-Base

## 1. Системные требования
- PHP 8.1+
- PostgreSQL 12+ или MySQL 8+
- Composer 2.0+
- Web-сервер (Apache/Nginx)
- Redis (опционально, для кеширования и хранения сессий)

## 2. Установка зависимостей
```bash
git clone https://github.com/botinplace/tc4u-base.git
cd tc4u-base
composer install
```

## 3. Настройка окружения
Создайте файл `.env`:
```bash
cp .env.example .env
```

Отредактируйте основные параметры:
```ini
# Настройки приложения
APP_ENV=production
APP_DEBUG=false
APP_URL=http://your-domain.com
URI_PREFIX=/tc4u

# База данных
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=tc4u_db
DB_USERNAME=tc4u_user
DB_PASSWORD=strong_password

# Почта (пример для Gmail)
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@email.com
MAIL_PASSWORD=app-specific-password
MAIL_ENCRYPTION=tls
```

## 4. Настройка базы данных
Для PostgreSQL:
```bash
sudo -u postgres psql
CREATE DATABASE tc4u_db;
CREATE USER tc4u_user WITH PASSWORD 'strong_password';
GRANT ALL PRIVILEGES ON DATABASE tc4u_db TO tc4u_user;
```

Примените миграции:
```bash
php database/migrations/migrate.php
```

## 5. Настройка веб-сервера

### Для Apache (virtual host):
```apache
<VirtualHost *:80>
    ServerName your-domain.com
    DocumentRoot /path/to/tc4u-base/public
    
    <Directory /path/to/tc4u-base/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/tc4u-error.log
    CustomLog ${APACHE_LOG_DIR}/tc4u-access.log combined
</VirtualHost>
```

### Для Nginx:
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/tc4u-base/public;
    
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
    }
}
```

## 6. Настройка прав доступа
```bash
chmod -R 755 storage
chown -R www-data:www-data storage
```

## 7. Дополнительные настройки

### LDAP (если требуется):
```ini
# .env
LDAP_ENABLED=true
AD_SERVER_1=ldap://dc1.example.com
AD_SERVER_2=ldap://dc2.example.com
AD_BASE_DN=OU=Users,DC=example,DC=com
AD_USERNAME=svc_ldap_user
AD_PASSWORD=ldap_password
```
<!--
### Кеширование Redis:
```ini
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
```

## 8. Запуск приложения
```bash
# Для разработки
php -S localhost:8000 -t public/

# Для production
sudo systemctl restart apache2  # или nginx
```

## 9. Тестирование установки
Откройте в браузере:
```
http://your-domain.com/tc4u/auth
```

## 10. Первоначальная настройка
1. Создайте первого администратора через CLI:
```bash
php scripts/create_admin.php --email=admin@example.com --password=AdminPass123
```

2. Настройте cron для периодических задач:
```bash
# crontab -e
* * * * * cd /path/to/tc4u-base && php cron.php
```

## 11. Обновление приложения
```bash
git pull origin main
composer install --no-dev
php database/migrations/migrate.php
```

-->

## Рекомендации по безопасности
1. Настройте SSL/TLS сертификат
2. Регулярно обновляйте зависимости
3. Используйте firewall
4. Настройте регулярное резервное копирование
5. Ограничьте доступ к `/storage` и `/config`

---

Для получения дополнительной помощи обратитесь к документации в репозитории или создайте issue на GitHub.
