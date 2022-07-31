
- project made with laravel 9, sanctum, spatie permission, cache and redis

- clone the project through: git clone https://github.com/mohanad69/ads_system.git
- composer install
- cp .env.example .env
- change environment variables
- type php artisan optimize:clear
- type php artisan migrate:fresh --seed

- login with creadentials: 
   ` email: admin@admin.com `
   ` password: password `
   
- all apis will be found in this link: https://documenter.getpostman.com/view/2912241/UzdxxQy6

- about views counting we will do the following: 
```
  1- adding views column in DB with default 0.
  2- adding an api to increment views. ex: frontend will make onClick event and when fire this event, he will call increment api.
  3- we can limit ad clicks by using "throttle" and in this case we will create new table "ad_views"
```
