# EMS

## Description
An event management system.
It is still a work in progress...

## Screenshot


## Steps to run in local machine
- Clone the repository
- cd into project directory
- Copy .env.example to .env
- Run ```composer install``` to install composer dependencies
- Run ```npm install``` to install npm dependencies
- Run ```php artisan key:generate``` to generate application key
- Run ```php artisan migrate``` to create all tables
- Run ```php artisan db:seed --class=CreateAdminSeeder``` to seed the database with the default login details for admin, counsellor and user
- Run ```php artisan serve``` to serve up the application
- The application can then be viewed on your local machine.

# Event Management System
# event-ms
