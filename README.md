## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## How to Run

-1 composer install <br>
-2 cp .env.example .env <br>
-3 php artisan key:generate <br>
-4 Create an empty database <br>
-5 In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD <br>
-6 php artisan migrate <br>
-7 php artisan db:seed --class=AdminUserSeeder <br>
-8 php artisan serve <br>
-9 login with [email == admin@gmail.com, password == 12345678] <br>


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
