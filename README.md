# Description

Source application used by client application

# Installation

1. Run:
```
git clone <repository_url>
composer install --no-dev --optimize-autoloader
```

2. Run (MySQL CLI or via phpMyAdmin):
```
CREATE DATABASE products_db;
CREATE USER 'products_app'@'localhost' IDENTIFIED BY 'jgfujykQELC8Qgn9dQp8fJ';
GRANT ALL PRIVILEGES ON products_db.* TO 'products_app'@'localhost';
```

3. Run:
```
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load
php bin/console cache:clear
```

4. Configure your server:
```
document root: public
domain: localhost/source_app/
```