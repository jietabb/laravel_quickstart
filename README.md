## create new project
        ref1: https://qiita.com/JUM22676603/items/016e3662b76977f4a161
        ref2: https://pointsandlines.jp/server-side/php/laravel-apache-vhost
###  config apache2
        httpd.conf
            LoadModule rewrite_module lib/httpd/modules/mod_rewrite.so
### create project:
        cd .../www/
        composer create-project laravel/laravel t1  "8.*"  --prefer-dist
        composer install

### prepare db:
        #install mysql, and create database laravel
        vim .env  # setup mysql password
        php artisan migrate
        php artisan db:seed

## laravel with apache
        # add vhost to http config
        # add permissions to project public directory
                <Directory "/Users/wang/www/t1/public">
                        Options Indexes FollowSymLinks
                        AllowOverride All
                        Require all granted
                </Directory>
        # restart apache2
## quickstart
        https://laravel.com/docs/5.1/quickstart
        php artisan make:migration create_tasks_table --create=tasks
        php artisan migrate
        php artisan make:model Task
        mkdir resources/views/layouts
        mkdir resources/views/common
        vim resources/views/layouts/app.blade.php
        vim resources/views/tasks.blade.php
        vim resources/views/common/errors.blade.php

## test curl
        vim /etc/hosts # add 127.0.0.1 la.localhost
        curl http://la.localhost/t
