0- project made with laravel 9, sanctum, spatie permission, cache and redis
1- clone the project through: git clone https://github.com/mohanad69/ads_system.git
2- type composer install
3- cp .env.example .env
4- change environment variables
5- type php artisan optimize:clear
6- type php artisan migrate:fresh --seed
7- login with creadentials: 
    email: admin@admin.com
    password: password
8- all apis will be found in this link: https://documenter.getpostman.com/view/2912241/UzdxxQy6
9- about views counting we will do the following: 
    a- Adding views column in DB with default 0.
    b- Adding an api to increment views. ex: frontend will make onClick event and when fire this event, he will call increment api.
    c- We can limit ad clicks by using "throttle" and in this case we will create new table "ad_views"
