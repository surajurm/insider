## Steps To Install This Projects

Open Command promt and follow follwing steps to run this projects  

### Clone git hub repo given above using following command:
- **git clone https://github.com/surajurm/insider.git**


### Move to project directory by following command:
- **cd insider**

### Install laravel dependencies by following command:
- **composer install**

### Copy .env.example into .env in same folder.

### Generate fresh application key by using following command:
- **php artisan key:generate**

### Configure database in .env file:
- **Update Database credentials in DB_DATABASE, DB_USERNAME, DB_PASSWORD etc.**

### Run following command to create table in database:
- **php artisan migrate**

### Import database given in attachment to insert data in to clubs table:

### Run following commands  to open project in browser.
- **php artisan serve**
