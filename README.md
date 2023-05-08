## LaravelStarter1
LaravelStarter1 laravel9 web template

### Todo first [appname = nom de la nouvelle application]
```shell
ligne 71 PagesController -- remplacer contact@laravelstarter1.com par contact@appname.com
ligne 1 .env -- changer le app name
ligne 37 .env -- remplacer "no-reply@laravelstarter1.com" par -- "no-reply@appname.com"
```

### Launch 
```shell
composer install
npm install
php artisan storage:link
php artisan migrate:fresh
php artisan serve
```