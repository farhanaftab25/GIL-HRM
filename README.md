## About GIL HRM Task <br>
Build with Laravel

1- Login for admin
![](screenshots/9.png)

2- Main Dashboard with All the statistics being implemented 
![](screenshots/1.png)

3- Bootstrap Modal showing Total Salary
![](screenshots/2.png)

4- Designation Entry form
![](screenshots/3.png)

5- Showing List of Designations
![](screenshots/4.png)

6- Employee Entry form
![](screenshots/5.png)

7- List of employees
![](screenshots/6.png)

8- Details view of employees
![](screenshots/7.png)

9- Entry form for adding employee information
![](screenshots/8.png)

## How to Run

-1) composer install <br>
-2) cp .env.example .env <br>
-3) php artisan key:generate <br>
-4) Create an empty database <br>
-5) In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD <br>
-6) php artisan migrate <br>
-7) php artisan db:seed --class=AdminUserSeeder <br>
-8) php artisan serve <br>
-9) login with [email == admin@gmail.com, password == 12345678] <br>


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
