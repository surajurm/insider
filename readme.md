

## Steps To Install This Projects

Open Command promt and follow follwing steps to run this projects  

### Clone git hub repo given above using following command:
- **git clone https://github.com/surajurm/insider.git**


### Move to project directory by following command:
- ** cd insider **

### Install laravel dependencies by following command:
- ** composer install **

### Copy .env.example into .env in same folder.

### Generate fresh application key by using following command:
- ** php artisan key:generate **

### Configure database in .env file:
- ** Update Database credentials in DB_DATABASE, DB_USERNAME, DB_PASSWORD etc. **

### Run following command to create table in database:
- ** php artisan migrate **

### Import database given in attachment to insert data in to clubs table:

### Run following commands  to open project in browser.
- ** php artisan serve **



## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
